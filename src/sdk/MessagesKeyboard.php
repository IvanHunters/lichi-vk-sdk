<?php


namespace Lichi\Vk\Sdk;


class MessagesKeyboard implements \Lichi\Vk\MessagesKeyboard
{

    /**
     * @return string
     */
    public static function hideKeyboard(): string
    {
        return '{"buttons":[],"one_time":true}';
    }

    /**
     * @param array $arrKeyboard
     * @param string $typeKeyboard
     * @return mixed
     */
    public function constructKeyboard(array $arrKeyboard, $typeKeyboard = "normal"): string
    {
        if($typeKeyboard == "inline"){
            $keyboard['inline'] = true;
            if(count($arrKeyboard) > 5){
                $arrKeyboard = array_slice($arrKeyboard, 0, 5);
            }
        }

        $keyboard['buttons']=array();

        foreach ($arrKeyboard as $i=>$line) {
            if(is_array($line)){
                if(isset($line['color'])){
                    $keyboard = $keyboard['buttons'][$i][0] = self::assocKeyboard($line['text'],$line['color']);
                }elseif(isset($line['type'])){
                    $keyboard['buttons'][$i][0] = self::assocKeyboard($line);
                }else{
                    foreach($line as $buttons){

                        if(is_array($buttons)){
                            if(isset($buttons['color'])){
                                $keyboard['buttons'][$i][] = self::assocKeyboard($buttons['text'],$buttons['color']);
                            }elseif(!isset($buttons['color'])){
                                $keyboard['buttons'][$i][] = self::assocKeyboard(@$buttons[0],@$buttons[1]);
                            }
                        }
                        else $keyboard['buttons'][$i][] = self::assocKeyboard($buttons);
                    }
                }
            }else{
                $keyboard['buttons'][$i][0] = self::assocKeyboard($line);
            }
        }
        return json_encode($keyboard, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @param string $color
     * @return mixed
     */
    private static function assocKeyboard($value, $color = "primary"): string
    {
        if($value == "location") return ['action'=>['type'=>'location']];
        elseif(isset($value['type']) && $value['type'] == "link")	return  ['action'=>['type'=>'open_link','link'=>$value['link'],"label"=>$value['text']]];
        else return ['action'=>['type'=>'text','label'=>$value],'color'=>$color];
    }
}