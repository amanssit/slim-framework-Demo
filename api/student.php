<?php
/**
 * Created by PhpStorm.
 * User: AMAN
 * Date: 12/30/2015
 * Time: 9:37 PM
 */
$app->get("/student","showstudent");
$app->get("/student/:id","showstudentbyid");
$app->post("/student","createStudent");
$app->post("/student/update","updateStudent");
$app->post("/student/delete","deleteStudent");

function showstudent()
{
    $app = \Slim\Slim::getInstance();
    $app->contentType('application/json');
    $sql = "SELECT id, name,city FROM `student`";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $response = array( "message"=>"success", "description"=>"Student Fetched Successfully","data"=> $students);
        $db = null;
        echo json_encode($response);
    } catch(PDOException $e) {
        $response = array( "message"=>"failure", "description"=>"Exception while fetching Students.","data"=>$e->getMessage());
        echo json_encode($response);
    }
}
function showstudentbyid($id)
{
    $app = \Slim\Slim::getInstance();
    $app->contentType('application/json');
    $sql = "SELECT id, name,city FROM `student` where id='$id'";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $response = array( "message"=>"success", "description"=>"Student Fetched Successfully","data"=> $students);
        $db = null;
        echo json_encode($response);
    } catch(PDOException $e) {
        $response = array( "message"=>"failure", "description"=>"Exception while fetching Students.","data"=>$e->getMessage());
        echo json_encode($response);
    }
}
function createStudent()
{
echo "Student Created";

    $app = \Slim\Slim::getInstance();
    $app->contentType('application/json');
    $request = $app->request();
   parse_str($request->getBody(),$student);

//    var_dump($category);exit;

    $sql = "INSERT INTO student (name, city ) VALUES (:name, :city)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $student["name"]);
        $name = $student["name"];
        $city= $student["city"];
        $stmt->bindParam("city", $city);
        $stmt->execute();
        $response = array( "message"=>"success", "description"=>"Category Created Successfully","data"=>$db->lastInsertId());
        $db = null;
        echo json_encode($response);
    } catch(PDOException $e) {
        $response = array( "message"=>"failure", "description"=>"Exception while creating Student.","data"=>$e->getMessage());
        echo json_encode($response);
    }
}
function updateStudent() {
    echo "Updated method";
    $app = \Slim\Slim::getInstance();
    $app->contentType('application/json');
    $request = $app->request();
    parse_str($request->getBody(),$student);
//    var_dump($category);exit;
    $sql = "UPDATE student SET name=:name, city=:city WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("name", $student["name"]);
        $stmt->bindParam("city", $student["city"]);;
        $stmt->bindParam("id", $student["id"]);
        $stmt->execute();
        $response = array( "message"=>"success", "description"=>"Student Updated Successfully");
        $db = null;
        echo json_encode($response);
    } catch(PDOException $e) {
        $response = array( "message"=>"failure", "description"=>"Exception while creating Student.","data"=>$e->getMessage());
        echo json_encode($response);
    }
}
function deleteStudent() {
    echo "Delete method";
    $app = \Slim\Slim::getInstance();
    $app->contentType('application/json');
    $request = $app->request();
    parse_str($request->getBody(),$student);
//    var_dump($category);exit;
    $sql = "DELETE from student WHERE id=:id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $student["id"]);
        $stmt->execute();
        $response = array( "message"=>"success", "description"=>"Student Deleted Successfully");
        $db = null;
        echo json_encode($response);
    } catch(PDOException $e) {
        $response = array( "message"=>"failure", "description"=>"Exception while creating Student.","data"=>$e->getMessage());
        echo json_encode($response);
    }
}