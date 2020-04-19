<?php
class Content{
 
    // database connection and table name
    private $conn;
    private $table_name = "xxxxxxxxx";
 
    // object properties
    public $id;
    public $title;
    public $summery;
    public $description;
    public $category_id;
    public $category_name;
    public $created;
    public $post_u_id;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function Test()
    {
        echo 'asdfasdfads';
    }
    // read products
    public function ReadAllData()
    {
        try {
			// select all query
            // $query = "SELECT * FROM " . $this->table_name;
            $query = "SELECT z_cms_post.id, z_cms_post.category_id, z_cms_post.post_title, z_cms_post.post_summary, z_cms_post.post_details, z_cms_post.post_u_id, z_cms_post.created_at, z_category.z_category_name FROM z_cms_post LEFT JOIN z_category ON z_cms_post.category_id = z_category.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

    // CreateContent
    public function CreateContent()
    {
        // query to insert record
        $sql = 'INSERT INTO z_cms_post (post_title, category_id, post_summary, post_u_id, post_details)
                                VALUES (:post_title, :category_id, :post_summary, :post_u_id, :post_details)';
        // prepare query
        $stmt = $this->conn->prepare($sql);
        
        // sanitize
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->summery=htmlspecialchars(strip_tags($this->summery));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->post_u_id=htmlspecialchars(strip_tags($this->post_u_id));
        
        // bind values
        $stmt->bindParam(":post_title", $this->title);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":post_summary", $this->summery);
        $stmt->bindParam(":post_u_id", $this->post_u_id);
        $stmt->bindParam(":post_details", $this->description);
        // return $stmt->bindParam(":post_details", $this->description);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function ReadOne()
    {
        $post_id = $this->id;
        // return $this->id;
        try {
			$query = "SELECT z_cms_post.id,z_cms_post.category_id, z_cms_post.post_title, z_cms_post.post_summary, z_cms_post.post_details, z_cms_post.created_at, z_cms_post.post_u_id, z_category.z_category_name FROM z_cms_post LEFT JOIN z_category ON z_cms_post.category_id = z_category.id WHERE z_cms_post.id=:post_id";
 
            // prepare query statement
            $stmt = $this->conn->prepare( $query );
        
            // bind id of product to be updated
            $stmt->bindParam(":post_id", $post_id);
            $stmt->execute();
        
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // print_r($row);
            // set values to object properties
            $this->id = $row['id'];
            $this->title = $row['post_title'];
            $this->summery = $row['post_summary'];
            $this->description = $row['post_details'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            $this->created = $row['created_at'];
            $this->post_u_id = $row['post_u_id'];

            return $row;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
}
?>