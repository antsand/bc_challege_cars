<?php
declare(strict_types=1);

class CarsController extends ControllerBase
{

    public function readAction()
    {
	    $this->view->disable();	

            $request = $this->request;
            $response = new \Phalcon\Http\Response();
            $response->setContent(json_encode('Error'));
            if ($request->isPost() && $request->isAjax()) {
		    $cars = new Cars();
		    $data = $cars->getdata();
		    if ($data) {
			    $response->setContent(json_encode($data));
		    }
	    }	
            return $response;
    }

}

