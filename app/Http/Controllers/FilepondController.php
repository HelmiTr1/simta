<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Sopamo\LaravelFilepond\Filepond;

class FilepondController extends Controller
{

    /**
     * @var Filepond
     */
    private $filepond;

    public function __construct(Filepond $filepond)
    {
        $this->filepond = $filepond;
    }

    /**
     * Uploads the file to the temporary directory
     * and returns an encrypted path to the file
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $file = $request->file('berkas');
        $filePath = tempnam(config('filepond.temporary_files_path'), "laravel-filepond");
        if ($file) {
            $filename = md5(Auth::user()->username).'.'.$file->getClientOriginalExtension();
                $file->move(public_path('storage'),$filename);
            // $filePathParts = pathinfo($filePath);

            // if(!$file->move($filePathParts['dirname'], $filePathParts['basename'])) {
            //     return Response::make('Could not save file', 500);
            // }
        }
        return Response::make($this->filepond->getServerIdFromPath($filePath), 200);
    }

    /**
     * Takes the given encrypted filepath and deletes
     * it if it hasn't been tampered with
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $filePath = $this->filepond->getPathFromServerId($request->getContent());
        if(unlink($filePath)) {
            return Response::make('', 200, [
                'Content-Type' => 'text/plain',
            ]);
        }

        return Response::make('', 500, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
