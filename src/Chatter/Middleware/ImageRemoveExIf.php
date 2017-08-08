<?php

namespace Chatter\Middleware;

class ImageRemoveExIf {
    
	public function __invoke($request, $response, $next) {

        $files = $request->getUploadedFiles();
        $newfile = $files['file'];

        $newfile_type = $newfile->getClientMediaType();
        $uploadFilename = $newfile->getClientFilename();

        $pngfile = "assets/images/" . substr($uploadFilename, 0 , -4) . ".png";

        if('image/jpeg' == $newfile_type) {
            $newfile->moveTo("assets/images/raw/$uploadFilename");
            $_img = imagecreatefromjpeg("assets/images/raw/" . $uploadFilename);
            imagepng($_img, $pngfile);
        }
        else {
            $newfile->moveTo("assets/images/$uploadFilename");
        }

        $request = $request->withAttribute('png_file', $pngfile);
        $response = $next($request, $response);

		return $response;
	}
}