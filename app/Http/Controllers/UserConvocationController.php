<?php

namespace App\Http\Controllers;

use App\Models\Convocation;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserConvocationController extends Controller
{
    //CREATE USER CONVOCATIONS
    public function createUserConvocations(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'convocation_id' => 'required',
                'user_id' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $validData = $validator->validated();

            $user = User::findOrFail($validData['user_id']);
            $convocationId = $validData['convocation_id'];

            $existingRelation = $user->convocation()->where('convocation_id', $convocationId)->exists();

            if ($existingRelation) {
                return response()->json([
                    'message' => 'El usuario ya tiene una solicitud creada para esta convocatoria'
                ], Response::HTTP_BAD_REQUEST);
            }

            $user->convocation()->attach($convocationId, ['status' => false]);

            return response()->json([
                'message' => 'Solicitud creada'
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::error('Error al crear la solicitud ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al crear la solicitud'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //ACCEPT USER REQUEST(ADMIN)
    public function acceptUserRequest(Request $request, $requestId)
    {
        try {
            $convocationRequest = DB::table('user_convocation')
                ->where('id', $requestId)
                ->first();

            if (!$convocationRequest) {
                return response()->json([
                    'message' => 'La solicitud de convocatoria no existe'
                ], Response::HTTP_NOT_FOUND);
            }

            DB::table('user_convocation')
                ->where('id', $requestId)
                ->update(['status' => true]);

            return response()->json([
                'message' => 'Solicitud de convocatoria aceptada exitosamente'
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::error('Error al aceptar la solicitud de convocatoria: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al aceptar la solicitud de convocatoria'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET PENDING CONVOCATION REQUEST
    public function getPendingUserRequests(Request $request)
    {
        try {
            // GET PENDING REQUEST (status = false) 
            $pendingRequests = DB::table('user_convocation')
                ->where('status', false)
                ->get();

            // GET INFO ABOUT USERS & CONVOCATIONS RELATED
            $requestsData = [];
            foreach ($pendingRequests as $request) {
                $user = User::find($request->user_id);
                $convocation = Convocation::find($request->convocation_id);

                if ($user && $convocation) {
                    // GET PROGRAM RELATED TO CONVOCATION
                    $program = Program::find($convocation->program_id);

                    $requestsData[] = [
                        'id' => $request->id,
                        'status' => $request->status,
                        'user' => $user,
                        'convocation' => $convocation,
                        'program' => $program,
                    ];
                }
            }
            return response()->json($requestsData);
        } catch (\Throwable $th) {
            Log::error('Error al obtener las solicitudes de convocatoria pendientes: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al obtener las solicitudes de convocatoria pendientes'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //GET MY ACCEPTED REQUEST AS USER
    public function getMyAcceptedUserRequests(Request $request, $userId)
    {
        try {
            $acceptedRequests = DB::table('user_convocation')
                ->where('status', true)
                ->where('user_id', $userId)
                ->get();

            $requestsData = [];
            foreach ($acceptedRequests as $request) {
                $user = User::find($request->user_id);
                $convocation = Convocation::find($request->convocation_id);

                if ($user && $convocation) {
                    $program = Program::find($convocation->program_id);

                    $requestsData[] = [
                        'id' => $request->id,
                        'status' => $request->status,
                        'user' => $user,
                        'convocation' => $convocation,
                        'program' => $program,
                    ];
                }
            }
            return response()->json($requestsData);
        } catch (\Throwable $th) {
            Log::error('Error al obtener las solicitudes de convocatoria aceptadas para el usuario ' . $userId . ': ' . $th->getMessage());
            return response()->json([
                'message' => 'Error al obtener las solicitudes de convocatoria aceptadas para el usuario ' . $userId
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    //GET ALL THE REQUEST
    public function getAllInscriptions(Request $request)
    {
        try {
            $allRequests = DB::table('user_convocation')->get();

            //GET INFO FROM USER AND CONVOCATIONS
            $requestsData = [];
            foreach ($allRequests as $request) {
                $user = User::find($request->user_id);
                $convocation = Convocation::find($request->convocation_id);

                if ($user && $convocation) {
                    //GET THE PROGRAM ASSING TO THE CONVOCATION
                    $program = Program::find($convocation->program_id);

                    $requestsData[] = [
                        'id' => $request->id,
                        'status' => $request->status,
                        'user' => $user,
                        'convocation' => $convocation,
                        'program' => $program,
                    ];
                }
            }
            return response()->json($requestsData);
        } catch (\Throwable $th) {
            Log::error('Error al obtener todas las solicitudes de convocatoria: ' . $th->getMessage());

            return response()->json([
                'message' => 'Error al obtener todas las solicitudes de convocatoria'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
