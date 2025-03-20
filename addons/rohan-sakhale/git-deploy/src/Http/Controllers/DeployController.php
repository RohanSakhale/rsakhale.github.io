<?php

namespace RohanSakhale\GitDeploy\Http\Controllers;

use Statamic\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;

class DeployController extends Controller
{
    public function index()
    {
        return view('git-deploy::index');
    }

    public function commitAndPush(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $commitMessage = "Auto commit from Statamic UI";

        try {
            $process = new Process([
                'bash', '-c',
                'git add . && git commit -m "' . $commitMessage . '" && git push origin main'
            ]);
            $process->setWorkingDirectory(base_path());
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return response()->json([
                'message' => 'Changes deployed successfully!',
                'output' => $process->getOutput()
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
