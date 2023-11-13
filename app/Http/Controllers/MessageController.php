<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Events\NewMessage;

class MessageController extends Controller
{
    //
    public function createMessage(Request $request, $program_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'program_id' => 'required',
                'message' => 'required',
                'date' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $validData = $validator->validated();

            $message = Message::create([
                'user_id' => $validData['user_id'],
                'program_id' => $program_id,
                'message' => $validData['message'],
                'date' => $validData['date']
            ]);


            // Emite el mensaje a través del canal WebSocket
            broadcast(new NewMessage($message));
            Log::info('Evento NewMessage emitido:', ['message' => $message]);

            
            return response()->json([
                'message' => 'Mensaje creado',
                'data' => $message
            ]);
        } catch (\Throwable $th) {
            Log::error('Error al crear el mensaje: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al crear el mensaje'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function messageReply(Request $request, $messageId)
    {
        try {
            // Validación de datos de entrada
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'program_id' => 'required',
                'message' => 'required',
                'date' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Error de validación', 'errors' => $validator->errors()], 400);
            }

            // Verificar si el mensaje original existe
            $parentMessage = Message::findOrFail($messageId);

            // Crear la respuesta
            $responseMessage = Message::create([
                'user_id' => $request->input('user_id'),
                'program_id' => $request->input('program_id'),
                'message' => $request->input('message'),
                'date' => $request->input('date'),
                'parent_id' => $messageId, 
            ]);

            // Emite la respuesta a través del canal WebSocket
            broadcast(new NewMessage($responseMessage));

            return response()->json(['message' => 'Respuesta creada con éxito', 'data' => $responseMessage], 201);
        } catch (\Throwable $th) {
            Log::error('Error al crear la respuesta: ' . $th->getMessage());

            return response()->json(['error' => 'Error interno del servidor', 'message' => 'Error al crear la respuesta'], 500);
        }
    }


    public function getResponses($messageId)
    {
        try {
            // Buscar el mensaje original
            $parentMessage = Message::findOrFail($messageId);

            // Obtener todas las respuestas relacionadas con el mensaje original
            $responses = Message::where('parent_id', $messageId)->get();

            return response()->json(['data' => $responses]);
        } catch (\Throwable $th) {
            Log::error('Error al obtener las respuestas: ' . $th->getMessage());

            return response()->json(['error' => 'Error interno del servidor', 'message' => 'Error al obtener las respuestas'], 500);
        }
    }
    
    public function editMessage(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required',
                'program_id' => 'required',
                'message' => 'required',
                'date' => 'required'
                // Agrega aquí otras reglas de validación según tus necesidades
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400); // 400 Bad Request
            }

            $validData = $validator->validated();

            $message = Message::find($id);

            if (!$message) {
                return response()->json([
                    'message' => 'Mensaje no encontrado'
                ], 404); // 404 Not Found
            }

            // Verificar la autorización para editar
            if ($message->user_id !== Auth::id()) {
                return response()->json([
                    'message' => 'No tienes permisos para editar este mensaje'
                ], 403); // 403 Forbidden
            }

            // Resto de la lógica de edición aquí...

        } catch (\Throwable $th) {
            Log::error('Error al actualizar mensaje: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al actualizar mensaje'
            ], 500); // 500 Internal Server Error
        }
    }

    // public function editResponse(Request $request, $id)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'user_id' => 'required',
    //             'program_id' => 'required',
    //             'message' => 'required',
    //             'date' => 'required'
    //             // Agrega aquí otras reglas de validación según tus necesidades
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json($validator->errors(), 400); // 400 Bad Request
    //         }

    //         $validData = $validator->validated();

    //         $message = Message::find($id); // Utiliza Message en lugar de Response

    //         if (!$message) {
    //             return response()->json([
    //                 'message' => 'Mensaje no encontrado'
    //             ], 404); // 404 Not Found
    //         }

    //         // Verificar la autorización para editar
    //         if ($message->user_id !== Auth::id()) {
    //             return response()->json([
    //                 'message' => 'No tienes permisos para editar este mensaje'
    //             ], 403); // 403 Forbidden
    //         }
    //     } catch (\Throwable $th) {
    //         Log::error('Error al actualizar mensaje: ' . $th->getMessage());

    //         return response()->json([
    //             'message' => 'Error al actualizar mensaje'
    //         ], 500); // 500 Internal Server Error
    //     }
    // }

    public function getAllMessages()
    {
        try {
            $messages = Message::with(['user', 'program', 'responses', 'messageParent'])->get();

            return response()->json([
                'message' => 'Mensajes obtenidos exitosamente',
                'data' => $messages
            ]);
        } catch (\Throwable $th) {
            Log::error('Error getting all messages: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error getting all messages'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteMessage($id)
    {
        try {
            $message = Message::find($id);

            if (!$message) {
                return response()->json([
                    'message' => 'Message not found'
                ], Response::HTTP_NOT_FOUND);
            }

            $message->delete();

            return response()->json([
                'message' => 'Mensaje borrado exitosamente'
            ]);
        } catch (\Throwable $th) {
            Log::error('Error al eliminar el mensaje: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al eliminar el mensaje'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteResponse($id)
    {
        try {
            $response = Message::find($id);

            if (!$response) {
                return response()->json([
                    'message' => 'Response not found'
                ], Response::HTTP_NOT_FOUND);
            }

            // Recursivamente eliminar respuestas hijas
            $this->deleteChildResponses($response);

            $response->delete();

            return response()->json([
                'message' => 'Respuesta y respuestas hijas borradas exitosamente'
            ]);
        } catch (\Throwable $th) {
            Log::error('Error al eliminar la respuesta: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al eliminar la respuesta'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
