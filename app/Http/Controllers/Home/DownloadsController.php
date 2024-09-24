<?php

namespace App\Http\Controllers\Home;

use App\Models\Apps;
use App\Models\Downloads;
use App\Models\Statics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DownloadsController extends Controller
{
    //
    public function index(Request $request)
    {
        $downloads = Downloads::where('publica', true)->orderBy('updated_at')->paginate(10);
        $info = Statics::where('tipo', 'descargas')->firstOrFail();
        return view('home.downloads',compact('downloads','info'));
    }
    public function download(Request $request, $file, $id)
    {
        switch ($file){
            case "apps":
                $app = Apps::where('id', $id)->firstOrFail();
                $archive = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($app->fichero);
                break;
            case "downloads":
                $dw = Downloads::where('id', $id)->firstOrFail();
                $archive = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($dw->fichero);
                break;

        }
        if ( file_exists( $archive ) ) {
            return response()->download($archive, basename($archive), [
                'Content-Length: '. filesize($archive)
            ] );

        }
    }
}
