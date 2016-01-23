<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function index($id){
        $module = CONTROLLER_NAME;
        switch($module){
            case 'Store':
                $modify = __MODULE__."/Store/modify/id/".$id.".html";
                $href = __MODULE__."/Store/detail/id/".$id.".html";
                break;
            case 'Marry':
                $modify = __MODULE__."/Marry/modify/id/".$id.".html";
                $href = __MODULE__."/Marry/detail/id/".$id.".html";
                break;
            case 'Happy':
                $modify = __MODULE__."/Happy/modify/id/".$id.".html";
                $href = __MODULE__."/Happy/detail/id/".$id.".html";
                break;
            case 'Car':
                $modify = __MODULE__."/Car/modify/id/".$id.".html";
                $href = __MODULE__."/Car/detail/id/".$id.".html";
                break;
            case 'House':
                $modify = __MODULE__."/House/modify/id/".$id.".html";
                $href = __MODULE__."/House/detail/id/".$id.".html";
                break;
            case 'Dianqi':
                $modify = __MODULE__."/Dianqi/modify/id/".$id.".html";
                $href = __MODULE__."/Dianqi/detail/id/".$id.".html";
                break;
            case 'Sea':
                $modify = __MODULE__."/Sea/modify/id/".$id.".html";
                $href = __MODULE__."/Sea/detail/id/".$id.".html";
                break;
            case 'Food':
                $modify = __MODULE__."/Food/modify/id/".$id.".html";
                $href = __MODULE__."/Food/detail/id/".$id.".html";
                break;
            case 'Farm':
                $modify = __MODULE__."/Farm/modify/id/".$id.".html";
                $href = __MODULE__."/Farm/detail/id/".$id.".html";
                break;
            case 'Edu':
                $modify = __MODULE__."/Edu/modify/id/".$id.".html";
                $href = __MODULE__."/Edu/detail/id/".$id.".html";
                break;
            case 'Retruit':
                $modify = __MODULE__."/Retruit/modify/id/".$id.".html";
                $href = __MODULE__."/Retruit/detail/id/".$id.".html";
                break;
            case 'Chang':
                $modify = __MODULE__."/Chang/modify/id/".$id.".html";
                $href = __MODULE__."/Chang/detail/id/".$id.".html";
                break;
            case 'Jiaju':
                $modify = __MODULE__."/Jiaju/modify/id/".$id.".html";
                $href = __MODULE__."/Jiaju/detail/id/".$id.".html";
                break;
            case 'Jiaju':
                $modify = __MODULE__."/Jiaju/modify/id/".$id.".html";
                $href = __MODULE__."/Jiaju/detail/id/".$id.".html";
                break;
            case 'Xiju':
                $modify = __MODULE__."/Xiju/modify/id/".$id.".html";
                $href = __MODULE__."/Xiju/detail/id/".$id.".html";
                break;
        }
        $this->assign('href', $href);
        $this->assign('modify', $modify);
        $this->display('Public/write-success');
    }

}