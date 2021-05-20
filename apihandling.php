<?php

require( "../config/main_config.php" );
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";


switch ( $action ) {
	
  case 'create':
    newBook();
    break;
  case 'update':
    editBook();
    break;
  case 'delete':
    deleteBook();
    break;
  case 'retrieve':
    retrieveBook();
    break;
  case 'search':
    searchBooks();
    break;
  case 'list':
    listBooks();
    break;
  
  default:
    homepage();
}



function newBook() 
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if($obj==null)
    {
        $check_user['message']="Please pass all mandatory details as JSON array";
        echo json_encode($check_user);	
        exit;
    }
    else
    {
        $data['title']=trim($obj->title);
        $data['author']=trim($obj->author);
        $data['isbn']=trim($obj->isbn);
        $data['release_date']=trim($obj->release_date);
        if($data['title']=="")
        {
            $check_user['message']="Please pass a valid book title";
            echo json_encode($check_user);	
            exit;
        }
        if($data['author']=="")
        {
            $check_user['message']="Please pass a valid author name";
            echo json_encode($check_user);	
            exit;
        }
        if($data['isbn']=="")
        {
            $check_user['message']="Please pass a valid isbn";
            echo json_encode($check_user);	
            exit;
        }
        if($data['release_date']=="")
        {
            $check_user['message']="Please pass a valid release date";
            echo json_encode($check_user);	
            exit;
        }
        $uniq_isbn_check = new Book();
        $list = $uniq_isbn_check->getByAttributesAnd("","",$data['isbn'],"");
        if($list==null)
        {
            $uniq_isbn_check->storeFormValues( $data );
	    $uniq_isbn_check->insert();
            $check_user['message']="Book entry added successfully";
            echo json_encode($check_user);	
            exit;
        }
        else
        {
            $check_user['message']="A book entry with this isbn already exist. Please pass a valid isbn";
            echo json_encode($check_user);	
            exit;  
        }
    }	
}

function retrieveBook()
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if($obj==null)
    {
        $check_user['message']="Please pass all mandatory details as JSON array";
        echo json_encode($check_user);	
        exit;
    }
    else
    {
        $data['isbn']=trim($obj->isbn);
        if($data['isbn']=="")
        {
            $check_user['message']="Please pass a valid isbn";
            echo json_encode($check_user);	
            exit;
        }
        $uniq_isbn_check = new Book();
        $list = $uniq_isbn_check->getByAttributesAnd("","",$data['isbn'],"");
        if($list!=null) {
        foreach($list['results'] as $firstentry) {
        $data = $firstentry;
        break;
        }
        echo json_encode($data);
        exit;
        }
        else
        {
            $check_user['message']="Please pass a valid isbn";
            echo json_encode($check_user);	
            exit;
        }
    }
}

function editBook() 
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if($obj==null)
    {
        $check_user['message']="Please pass all mandatory details as JSON array";
        echo json_encode($check_user);	
        exit;
    }
    else
    {
        $data['book_id']=trim($obj->book_id);
        $data['title']=trim($obj->title);
        $data['author']=trim($obj->author);
        $data['isbn']=trim($obj->isbn);
        $data['release_date']=trim($obj->release_date);
        if($data['book_id']=="")
        {
            $check_user['message']="Please pass a valid book id to update";
            echo json_encode($check_user);	
            exit;
        }
        if($data['title']=="")
        {
            $check_user['message']="Please pass a valid book title";
            echo json_encode($check_user);	
            exit;
        }
        if($data['author']=="")
        {
            $check_user['message']="Please pass a valid author name";
            echo json_encode($check_user);	
            exit;
        }
        if($data['isbn']=="")
        {
            $check_user['message']="Please pass a valid isbn";
            echo json_encode($check_user);	
            exit;
        }
        if($data['release_date']=="")
        {
            $check_user['message']="Please pass a valid release date";
            echo json_encode($check_user);	
            exit;
        }
        $update_entry = new Book();
        $update_info = $update_entry->getById($data['book_id']);
        if($update_info==null)
        {
            $check_user['message']="This entry does not exist. Please pass a valid book id to update";
            echo json_encode($check_user);	
            exit;
        }
        $check_id1 = $check_id2 = $update_info->book_id;
        $list = $update_entry->getByAttributesAnd("","",$data['isbn'],"");
        if($list!=null) {
        foreach($list['results'] as $firstentry) {
        $check_id2 = $firstentry->book_id;
        break;
        }
        }
        if($check_id1==$check_id2)
        {
            $update_entry->storeFormValues( $data );
	    $update_entry->update();
            $check_user['message']="Book entry values updated successfully";
            echo json_encode($check_user);	
            exit;
        }
        else
        {
            $check_user['message']="A book entry with this isbn already exist. Please pass a valid isbn";
            echo json_encode($check_user);	
            exit;  
        }
    }	
}

function deleteBook() 
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if($obj==null)
    {
        $check_user['message']="Please pass all mandatory details as JSON array";
        echo json_encode($check_user);	
        exit;
    }
    else
    {
        $data['book_id']=trim($obj->book_id);
        if($data['book_id']=="")
        {
            $check_user['message']="Please pass a valid book id to delete";
            echo json_encode($check_user);	
            exit;
        }
        $delete_entry = new Book();
        $delete_info = $delete_entry->getById($data['book_id']);
        if($delete_info==null)
        {
            $check_user['message']="This entry does not exist. Please pass a valid book id to delete";
            echo json_encode($check_user);	
            exit;
        }
        $delete_entry->storeFormValues( $data );
        $delete_entry->delete();
        $check_user['message']="Book entry deleted successfully";
        echo json_encode($check_user);	
        exit;
    }
}


function listBooks() 
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if($obj==null)
    {
        $check_user['message']="Please pass all mandatory details as JSON array";
        echo json_encode($check_user);	
        exit;
    }
    else
    {
        $offset=trim($obj->offset);
        $itemcount=trim($obj->itemcount);
        if($offset=="")
        {
            $check_user['message']="Please pass a valid offset count";
            echo json_encode($check_user);	
            exit;
        }
        if($itemcount=="")
        {
            $check_user['message']="Please pass a valid itemcount";
            echo json_encode($check_user);	
            exit;
        }
        $list_entry = new Book();
        $list_info = $list_entry->getList($offset,$itemcount);
        if($list_info==null)
        {
            $check_user['message']="There is no valid data. Please check offset and itemcount";
            echo json_encode($check_user);	
            exit;
        }
        //print_r($list_info);
        echo json_encode($list_info);	
        exit;
    }
}

function searchBooks() 
{
    $json = file_get_contents('php://input');
    $obj = json_decode($json);
    if($obj==null)
    {
        $check_user['message']="Please pass all mandatory details as JSON array";
        echo json_encode($check_user);	
        exit;
    }
    else
    {
        $title=trim($obj->title);
        $author=trim($obj->author);
        $isbn=trim($obj->isbn);
        $release_date=trim($obj->release_date);
        $match_filter=trim($obj->match_filter);
        if($title=="" && $author=="" && $isbn=="" && $release_date=="")
        {
            $check_user['message']="Please pass at least one filter say author or title or isbn or release_date to search bookstore";
            echo json_encode($check_user);	
            exit;
        }
        $search_entry = new Book();
        if($match_filter=="any")
        {
            $search_info = $search_entry->getByAttributesOr($title,$author, $isbn, $release_date);
        }
        else if($match_filter=="strict")
        {
            $search_info = $search_entry->getByAttributesAnd($title,$author, $isbn, $release_date);
        }
        if($search_info==null)
        {
            $check_user['message']="There is no valid data with these search filters";
            echo json_encode($check_user);	
            exit;
        }
        echo json_encode($search_info);	
        exit;
    }
}

function homepage()
{
header('Location: http://18.116.116.222/bookstoreapis/');
exit;
}

?>