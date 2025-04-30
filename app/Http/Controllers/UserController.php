<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserCustomEmail;
use App\Mail\customUserEmail;
use App\Models\User;
use App\Repositories\AdminRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Mail;

class UserController extends Controller
{
    public function getUsers(Request $request){
        // Update inactive users first
        User::whereNotNull('last_login_at')
            ->where('last_login_at', '<', now()->subDays(10))
            ->where('status', '!=', 'Inactive')
            ->where('status', '!=', 'Suspended')
            ->update(['status' => 'Inactive']);
            
        // Then get paginated results
        // $usersStatistics=UserRepository::getUserStatistics();
        $users = UserRepository::getUsers(
            request()->input('search'),
            request()->input('status'),
            request()->input('role'),
            request()->input('sort')
        );
        return response()->json($users, 200);
    }

    public function emailUser(Request $request){
        
        try {
            $validated = $request->validate([
                "subject" => "required",
                "message" => "required",
            ]);
            
            $user = User::findOrFail($request->user_id);
            $admin = User::findOrFail($request->sent_by);
            $subject = $request->subject;
            $message = $request->message;
            $send_copy = $request->send_copy;

            // Mail::to($user->email)->send(new customUserEmail($user, $subject, $message));
            SendUserCustomEmail::dispatch($user, $subject, $message);
            
            if($send_copy) {
            // Mail::to($admin->email)->send(new customUserEmail($user, $subject, $message));
                SendUserCustomEmail::dispatch($user,$subject,$message,$admin);

            }
            
            return response()->json([
                "message" => "Email sent successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to send email: " . $e->getMessage()
            ], 400);
        }
    }

    public function suspendUser(Request $request){ {
        /** user_id: userId,
        **suspended_by: {{ auth()->user()->id }},
          **              reason,
            **            details,
              **          send_email: sendEmail */
        try {
            $validated = $request->validate([
                "user_id" => "required|exists:users,id",
                "suspended_by" => "required|exists:users,id",
                "reason" => "required|string",
                "details" => "nullable|string",
                "send_email" => "nullable|boolean",
            ]);
            
            $user = User::findOrFail($request->user_id);
            $admin = User::findOrFail($request->suspended_by);
            $reason = $request->reason;
            $details = $request->details;
            $send_email = $request->send_email;

            // Update user status to suspended
            $user->update([
                'status' => 'Suspended',
                'suspended_by' => $admin->id,
                'suspension_reason' => $reason,
                'suspension_details' => $details,
                'suspended_at' => now(),
            ]);
            // Send email notification to user
            $subject = 'Suspension Notification';
            $message = 'You have been suspended for the following reason: ' . $reason . ' ' . $details;
            
            if($send_email) {
                // Mail::to($admin->email)->send(new customUserEmail($user, $subject, $message));
                SendUserCustomEmail::dispatch($user,$subject, $message);
            }
            
            return response()->json([
                "message" => "User suspended successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to suspend user: " . $e->getMessage()
            ], 400);
        }
    }

  }

    public function activateUser(Request $request){
        try {
            $validated = $request->validate([
                "user_id" => "required|exists:users,id",
            ]);
            
            $user = User::findOrFail($request->user_id);
            $send_email = $request->send_email;

            // Update user status to active
            $user->update([
                'status' => 'Active',
                'suspended_by' => null,
                'suspension_reason' => null,
                'suspension_details' => null,
                'suspended_at' => null,
            ]);
            
            // Send email notification to user
            
                // Mail::to($admin->email)->send(new customUserEmail($user, 'Account Activation', 'Your account has been activated.'));
                $subject = 'Account Activation';
                $message = 'Your account has been activated.';
                SendUserCustomEmail::dispatch($user,$subject, $message);
            
            
            return response()->json([
                "message" => "User activated successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to activate user: " . $e->getMessage()
            ], 400);
        }
    }

    public function editUser(Request $request){
        /**
         *  user_id: userId,
            *        role,
           *         status,
             *       email_verified: emailVerified,
              *      admin_notes: notes
         */
        try {
            $validated = $request->validate([
                "user_id" => "required|exists:users,id",
                "role" => "nullable|string",
                "status" => "nullable|string",
                "email_verified" => "nullable|boolean",
                "admin_notes" => "nullable|string",
            ]);
            
            $user = User::findOrFail($request->user_id);
            $user->update([
                'role' => $request->role,
                'status' => $request->status,
                'email_verified_at' => $request->email_verified ? now() : null,
                'admin_notes' => $request->admin_notes,
            ]);
            
            return response()->json([
                "message" => "User updated successfully"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Failed to update user: " . $e->getMessage()
            ], 400);
        }
    }

    public function getUsersStatistics(){
        $statistics=UserRepository::getUserStatistics();
        return response()->json($statistics, 200);
    }


    public function getAdminDashboardStatistics(Request $request){
        $date=$request->date;
        $statistics = AdminRepository::getPlatformGrowth($date);
        return response()->json($statistics, 200);
    }

}
