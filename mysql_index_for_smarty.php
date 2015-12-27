<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors',1);
    header('Content-type: text/html; charset=utf-8');
    
//    $project_root = $_SERVER['DOCUMENT_ROOT'];
    $smarty_dir = /*$_SERVER['DOCUMENT_ROOT'].*/'./smarty/';

    // put full path to Smarty.class.php
    require($smarty_dir.'/libs/Smarty.class.php');
    $smarty = new Smarty();

    $smarty->template_dir = $smarty_dir . 'templates';
    $smarty->compile_dir = $smarty_dir . 'templates_c';
    $smarty->cache_dir = $smarty_dir . 'cache';
    $smarty->config_dir = $smarty_dir . 'configs';
        
    
    $str=file_get_contents('config.txt');
    
    $config = parse_ini_string($str, true); // возвращаем файл config.txt в виде массива
    
        $hostName=$config['hostName'];
        $userName=$config['userName'];
        $dbPassword=$config['dbPassword'];
        $dbName=$config['dbName']; 
    
    $dbc=mysql_connect($hostName, $userName, $dbPassword) or die('Не удалось подключиться к БД') . mysql_error();
    mysql_select_db($dbName) or die('Не удалось выбрать БД') . mysql_error();
    mysql_query('set names utf8') or die('Не удалось установить кодировку utf8'). mysql_error();

    
    $query = "select category_number, category_name, section from category";

    $result = mysql_query($query) or die('Запрос не удался'). mysql_error();

    while($row = mysql_fetch_assoc($result))
        {
            $section = $row['section'];
            $categories[$section][$row['category_number']]=$row['category_name'];
        }
    
        
    $query = "select * from cities";
    
    $result=mysql_query($query);
    
    while($row = mysql_fetch_assoc($result))
        {
            $number = $row['number'];
            $city = $row['city'];
            $cities[$number] = $city;
        }
        
        
    function prepareAD($data=null, $head=null, $button=null)
            {
                $out = array();
                $out['private'] = isset($data['private'])?$data['private']:'1';
                $out['seller_name'] = isset($data['seller_name'])?$data['seller_name']:'';
                $out['email'] = isset($data['email'])?$data['email']:'';
                $out['phone'] = isset($data['phone'])?$data['phone']:'';
                $out['location_id'] = isset($data['location_id'])?$data['location_id']:'';
                $out['checkbox'] = isset($data['checkbox'])?$data['checkbox']:'';
                $out['category_id'] = isset($data['category_id'])?$data['category_id']:'';
                $out['title'] = isset($data['title'])?$data['title']:'';
                $out['description'] = isset($data['description'])?$data['description']:'';
                $out['price'] = isset($data['price'])?$data['price']:'';
            
                if (isset($head))
                    {
                        $out['head'] = $head;
                    }
                
                 if (isset($button))
                    {
                        $out['button'] = $button;
                    }   
                    
                return $out;
            }
            
    function query ($data,$id)     //функция запросов к БД
            {   $out='';
                if(!is_numeric($id))
                    {
                        $out="INSERT INTO `adStore` (`private`, `seller_name`, `email`, `phone`, `location_id`, `checkbox`, `category_id`, 
                            `title`, `description`, `price`, `main_form_submit`, `hidden`)
                                VALUES ('".$data['private']."'," . "'".$data['seller_name']."',". "'". $data['email']."'," . "'".$data['phone']."'," . "'".$data['location_id']."'," . "'".$checkbox=$data['checkbox']."'," 
                                    . "'".$data['category_id']."',". "'". $data['title']."'," . "'".$data['description']."',". "'".$data['price']."'," . "'".$data['main_form_submit']."',". "'".$data['hidden']. "');";
                    }
                else 
                    {
                        $out="UPDATE `adStore` SET
                                        `private` = '".$data[$id]['private']."',
                                        `seller_name` = '".$data[$id]['seller_name']."',
                                        `email` = '".$data[$id]['email']."',
                                        `phone` = '".$data[$id]['phone']."',
                                        `location_id` = '".$data[$id]['location_id']."',
                                        `checkbox` = '".$data[$id]['checkbox']."',
                                        `category_id` = '".$data[$id]['category_id']."',
                                        `title` = '".$data[$id]['title']."',
                                       `description` = '".$data[$id]['description']."',
                                        `price` = '".$data[$id]['price']."',
                                        `main_form_submit` = '".$main_form_submit=isset($data[$id]['main_form_submit'])?$data[$id]['main_form_submit']:''."',
                                        `hidden` = '".$hidden=isset($data[$id]['hidden'])?$data[$id]['hidden']:''."'
                                         WHERE `id` = '".$id."';";
                    }    
                return $out;
            }        
            
                                
    $formParams = prepareAD($data=null, $head = 'Страница добавления объявления', $button = 'Далее');         

    $adStore=array();    
    
    $query = "select * from adStore";
    $result=mysql_query($query) or die('Запрос для $adStore не удался: '). mysql_error();

    while($row=mysql_fetch_assoc($result))
        {
            $adStore[$row['id']]=$row;
        }
  
    
    $id = (isset($_GET['id']))?$_GET['id']:'';
          
    if (isset($_GET['id']))
        {
            $ad = $adStore[$id];
            $formParams = prepareAD($ad, $head = 'Страница редактирования', $button = 'Готово');
        }
    else 
        {   
            if (isset($_GET['del']))  //удаление объявления
                {             
                    $id_for_del = $_GET['del'];
                    $query="DELETE FROM `adStore`
                                WHERE ((`id` = '".$id_for_del."'));";
                    $result=mysql_query($query);
                    
                    header('Location: mysql_index_for_smarty.php');
                }
                
            if (isset($_POST['main_form_submit'])) //	всё, что пришло из формы записать в БД 
                {                     
                        
                            $uns = isset($adStore)?$adStore:array();
                            $id = isset($_POST['hidden'])?$_POST['hidden']:'';
                              if (!is_numeric($id))                        //добавление нового объявления
                                  {
                                    $uns = prepareAD($_POST);
                                    $adStore = $uns;
                                    
                                    
                                    
                                    $query = query($adStore, $id);
                                    
                                    $result=mysql_query($query) or die('Не удалось выполнить запрос: ') . mysql_error();
                                    
                                    header('Location: mysql_index_for_smarty.php');
                                    
                                   
                                  }
                               else
                                   {                                   
                                        $uns[$id] = prepareAD($_POST);  // добавление отредактированного объявления
                                        
                                        $adStore = $uns;
                                        
                                        $query= query($adStore,$id);
                                        $result=mysql_query($query);
                                        $id = '';
                                        
                                    }
                        
                    unset($_POST);
                }
           }
           mysql_close($dbc);          
           
    $for_radios = array( 
        1 => 'Частное лицо',
        0 => 'Компания'
    );

    if ($formParams['private'] == 1)
        { 
            $for_radios_checked = 1;
        } 
    elseif($formParams['private'] == 0) 
        {
            $for_radios_checked = 0;
        }

    $id=(isset($id))?$id:'';                 // условие, чтобы не было ошибки после редактирования объявления
    
    $smartyParams = array(                   
        'formParams' =>$formParams,
        'adStore' => $adStore,
        'id' => $id,
        'cities' => $cities,
        'categories' => $categories,
        'for_radios' => $for_radios,
        'for_radios_checked' => $for_radios_checked
        
    );
    
    $smarty->assign('smartyParams', $smartyParams);
     
    $smarty->display('mysql_index_for_smarty.tpl');