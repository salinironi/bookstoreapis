<?php
class Book
{
  public $book_id = null;
  public $title = null;
  public $author = null;
  public $isbn = null;
  public $release_date = null;
  

  public function __construct( $data=array() ) {
    if ( isset( $data['book_id'] ) ) $this->book_id = (int) $data['book_id'];
    if ( isset( $data['title'] ) ) $this->title = $data['title'];
    if ( isset( $data['author'] ) ) $this->author = $data['author'];
    if ( isset( $data['isbn'] ) ) $this->isbn = $data['isbn'];
    if ( isset( $data['release_date'] ) ) $this->release_date = $data['release_date'];
    //if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['title'] );
  }

  public function storeFormValues ( $params ) {
    $this->__construct( $params );
  }

  public static function getById( $book_id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM books WHERE book_id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $book_id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Book( $row );
    else
        return null;
  }
  public static function getByAttributesOr( $title = "" ,$author = "", $isbn = "", $release_date = "" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM books";
    if(trim($title)!="" || trim($author)!="" || trim($isbn)!="" || trim($release_date)!="")
    {
        $sql.=" WHERE (";
    }
    if(trim($title)!="")
    {
        $sql.="title=:title or ";
    }
    if(trim($author)!="")
    {
        $sql.="author=:author or ";
    }
    if(trim($isbn)!="")
    {
        $sql.="isbn=:isbn or ";
    }
    if(trim($release_date)!="")
    {
        $sql.="release_date=:release_date or ";
    }
    $sql = substr($sql,0,-4);
    if(trim($title)!="" || trim($author)!="" || trim($isbn)!="" || trim($release_date)!="")
    {
        $sql.=");";
    }
    $st = $conn->prepare( $sql );
    if(trim($title)!="")
    {
        $st->bindValue( ":title", $title, PDO::PARAM_STR );
    }
    if(trim($author)!="")
    {
        $st->bindValue( ":author", $author, PDO::PARAM_STR );
    }
    if(trim($isbn)!="")
    {
        $st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
    }
    if(trim($release_date)!="")
    {
        $st->bindValue( ":release_date", $release_date, PDO::PARAM_STR );
    }
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $book = new Book( $row );
      $list[] = $book;
    }
    
    $conn = null;
    if($list!=null)
     return ( array ( "results" => $list,"count" =>count($list)));
    else
    {
        return null;
    }
  }

  public static function getByAttributesAnd( $title,$author, $isbn, $release_date ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM books";
    if(trim($title)!="" || trim($author)!="" || trim($isbn)!="" || trim($release_date)!="")
    {
        $sql.=" WHERE (";
    }
    if(trim($title)!="")
    {
        $sql.="title=:title and ";
    }
    if(trim($author)!="")
    {
        $sql.="author=:author and ";
    }
    if(trim($isbn)!="")
    {
        $sql.="isbn=:isbn and ";
    }
    if(trim($release_date)!="")
    {
        $sql.="release_date=:release_date and ";
    }
    $sql = substr($sql,0,-5);
    if(trim($title)!="" || trim($author)!="" || trim($isbn)!="" || trim($release_date)!="")
    {
        $sql.=");";
    }
    $st = $conn->prepare( $sql );
    if(trim($title)!="")
    {
        $st->bindValue( ":title", $title, PDO::PARAM_STR );
    }
    if(trim($author)!="")
    {
        $st->bindValue( ":author", $author, PDO::PARAM_STR );
    }
    if(trim($isbn)!="")
    {
        $st->bindValue( ":isbn", $isbn, PDO::PARAM_STR );
    }
    if(trim($release_date)!="")
    {
        $st->bindValue( ":release_date", $release_date, PDO::PARAM_STR );
    }
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $book = new Book( $row );
      $list[] = $book;
    }
    
    $conn = null;
    if($list!=null)
     return ( array ( "results" => $list,"count" =>count($list)));
    else
    {
        return null;
    }
  }
  
  public static function getList( $offset,$itemcount, $order="book_id DESC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM books
            ORDER BY " . ($order) . " LIMIT ".$offset.",".$itemcount;
    $st = $conn->prepare( $sql );
    //$st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $book = new Book( $row );
      $list[] = $book;
    }

    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
  
  public function insert() {

    if ( !is_null( $this->book_id ) ) trigger_error ( "Book::insert(): Attempt to insert a Book object that already has its ID property set to( $this->book_id ).", E_USER_ERROR );

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO books ( title, author, isbn, release_date) 
    		VALUES ( :title, :author, :isbn, :release_date )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":author", $this->author, PDO::PARAM_STR );
    $st->bindValue( ":isbn", $this->isbn, PDO::PARAM_STR );
    $st->bindValue( ":release_date", $this->release_date, PDO::PARAM_STR );
    $st->execute();
    $conn = null;
    return $this->book_id;
  }

  public function update() {

    // Does the Content object have an ID?
    if ( is_null( $this->book_id ) ) trigger_error ( "Book::update(): Attempt to update a Book object that does not have its ID property set.", E_USER_ERROR );
   
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE books SET title=:title, author=:author, isbn=:isbn, release_date=:release_date WHERE book_id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":author", $this->author, PDO::PARAM_STR );
    $st->bindValue( ":isbn", $this->isbn, PDO::PARAM_STR );
    $st->bindValue( ":release_date", $this->release_date, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->book_id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  /**
  * Deletes the current Book object from the database.
  */
  
  public function delete() {

    if ( is_null( $this->book_id ) ) trigger_error ( "Book::delete(): Attempt to delete a Book object that does not have its ID property set.", E_USER_ERROR );

    // Delete the Book
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    
    $st = $conn->prepare ( "DELETE FROM books WHERE book_id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->book_id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
    
  }
  


}
?>
