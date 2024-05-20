<?php
   // Database Connection
   include '../../../config/connection.php';

   // Reading value
   $draw = $_POST['draw'];
   $row = $_POST['start'];
   $rowperpage = $_POST['length']; // Rows display per page
   $columnIndex = $_POST['order'][0]['column']; // Column index
   $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
   $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
   $searchValue = $_POST['search']['value']; // Search value
   
   $table = $_POST['tableName'];
   $type = $_POST['type'];

   $searchArray = array();
   $columns = array();

   foreach ($_POST['columns'] as $column) {
      if (isset($column['data'])) {
         $columns[] = $column['data'];
      }else{
         continue;
      }
   }

   
   $columns_str = implode(",", $columns);

   $columns_str_1 = implode(',', array_map(function($item) {
         return 'c.'.$item;
   }, $columns));

   // Search
   $searchQuery = " ";
   if (!empty($searchValue)) {
      $searchQuery = " AND (";
      $conditions = array();
      foreach ($columns as $field) {
         if ($field !== 'action' && $field !== 'present' && $field !== "day1" && $field !== "day2" && $field !== "day3" && $field !== "day4" && $field !== "day5" && $field !== "day6" && $field !== "day7") {
            if($type === 'view'){

               $conditions[] = "$field LIKE :$field";
               $searchArray[$field] = "%$searchValue%";

            }else if($type === 'attendance' || $type === 'mark_attendance' || $type === 'assignVideoTest'){
               if($field !== 'attendace_id') {
                  $conditions[] = "c.$field LIKE :$field";
                  $searchArray[$field] = "%$searchValue%";
               }
            }else if($type === 'eval_pending' || $type === 'eval_history'){
               if($field !== 'test_id') {
                  if($field === 'student_id' || $field === 'attempted_on' || $field === 'evaluation_on'){
                     $conditions[] = "pt.$field LIKE :$field";
                  }else if($field === 'assigned_on'){
                     $conditions[] = "ta.$field LIKE :$field";
                  }else if($field === 'test_name'){
                     $conditions[] = "t.name LIKE :$field";
                  }else if($field === 'student_name'){
                     $conditions[] = "s.name LIKE :$field";
                  }
                  $searchArray[$field] = "%$searchValue%";
               }    
            }
         }
      }
      $searchQuery .= implode(" OR ", $conditions);
      $searchQuery .= ")";
  }

   
//=============================================
// =========== All the users details ==========
//=============================================

   if($type === 'view'){
      $sql = "SELECT ".$columns_str." FROM ".$table." WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset";
      $searchCount = "SELECT COUNT(*) AS allcount FROM ".$table." WHERE 1 ".$searchQuery;
      $totalCount = "SELECT COUNT(*) AS allcount FROM ". $table;
   }

   
  
//====================================================   
//============ All the attendance details ============
//====================================================
   else if($type === 'attendance'){
      $day12 = ""; 
      $interval = "";

      // given 7days present, absent or leave
      for ($i = 1; $i <= 7; $i++) {
          $day = "day" . $i;
      
          $day12 .= "CASE 
                     WHEN COUNT(CASE WHEN a.attendance_date = CURDATE() $interval AND a.leave_id IS NOT NULL THEN 1 ELSE NULL END) > 'absent' THEN 'leave' 
                     WHEN COUNT(CASE WHEN a.attendance_date = CURDATE() $interval AND a.".$columns[0]." IS NOT NULL THEN 1 ELSE NULL END) > 'absent' THEN 'present' 
                     ELSE 'absent' 
                  END AS $day,";

          $interval = "- INTERVAL $i DAY";

      }
      
      $day12 = rtrim($day12, ',');
      
   
   
      // Fetch records
      $sql = "SELECT c.".$columns[0].", c.name, ".$day12."  
              FROM ".$table." AS c 
              LEFT JOIN attendance AS a ON c.".$columns[0]." = a.".$columns[0]."  
              WHERE 1 ".$searchQuery." AND c.activation = 1
              GROUP BY c.".$columns[0].", c.name 
              ORDER BY ".$columnName." ".$columnSortOrder." 
              LIMIT :limit,:offset";   

      // Total number with filtering
      $searchCount = "SELECT COUNT(*) AS allcount FROM ".$table." AS c WHERE 1 ".$searchQuery." AND c.activation = 1";

      // Total number 
      $totalCount = "SELECT COUNT(*) AS allcount FROM ". $table." AS c WHERE c.activation = 1";
   }


//=======================================================  
//========== All attendance marking details =============
//=======================================================
   else if($type === 'mark_attendance'){

      $date = $_POST['selectedDate'];

      // Fetch records
      $sql = "SELECT c.".$columns[0].", c.name, a.attendance_id,
                  CASE WHEN a.".$columns[0]." IS NOT NULL THEN 1 ELSE 0 END AS present
              FROM ".$table." AS c 
              LEFT JOIN attendance AS a ON c.".$columns[0]." = a.".$columns[0]." AND a.attendance_date = '$date'  
              WHERE 1 ".$searchQuery." AND c.activation = 1 GROUP BY c.".$columns[0].", c.name ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset";  
      
      // Total number with filtering
      $searchCount = "SELECT COUNT(*) AS allcount 
                      FROM ".$table." AS c 
                      LEFT JOIN attendance AS a ON c.".$columns[0]." = a.".$columns[0]." AND a.attendance_date = '$date'
                      WHERE c.activation = 1";

      // Total number 
      $totalCount = "SELECT COUNT(*) AS allcount 
                     FROM ".$table." AS c
                     LEFT JOIN attendance AS a ON c.".$columns[0]." = a.".$columns[0]." AND a.attendance_date = '$date'
                     WHERE c.activation = 1";

   }

//===========================================================  
//========== All Test & Videos assigning details ============
//===========================================================
else if($type === 'assignVideoTest'){

   $test_video_column = '';

   for ($i = 1; $i < count($columns); $i++) {
       $test_video_column .= ($i > 1 ? ', ' : '') . 'c.' . $columns[$i];
   }
   
   $table2 = $_POST['tableName_2'];
   $id = $_POST['id'];

   $sql = "SELECT ".$test_video_column.",ta.ispresent AS present
           FROM ".$table." AS c
           LEFT JOIN $table2 ta ON c.$columns[1] = ta.$columns[1] AND ta.batch_id = $id
           WHERE 1 ".$searchQuery." 
           ORDER BY ".$columnName." ".$columnSortOrder." 
           LIMIT :limit,:offset";
   $searchCount = "SELECT COUNT(*) AS allcount FROM ".$table." AS c WHERE 1 ".$searchQuery;
   $totalCount = "SELECT COUNT(*) AS allcount FROM ". $table;

}

//===========================================================  
//=============== All Evaluation details ====================
//===========================================================
else if($type === 'eval_pending' || $type === 'eval_history'){

   $eval_tables = "FROM testass AS ta 
                   JOIN paidtest AS pt ON ta.test_id = pt.test_id
                   JOIN student AS s ON pt.student_id = s.student_id
                   JOIN test AS t ON t.test_id = pt.test_id";

   if($type === 'eval_pending'){
      $eval_condition = "AND pt.attempted = 1 
                         AND pt.evaluated != 1";
   }else{
      $eval_condition = "AND pt.evaluated = 1";
   }
   

   $sql = "SELECT ta.assigned_on, pt.student_id, s.name AS student_name, pt.attempted_on, t.name AS test_name, t.test_id, pt.evaluation_on
        ".$eval_tables."
        WHERE 1 ".$searchQuery." 
        ".$eval_condition."
        AND ta.batch_id IN (SELECT batch_id FROM assignstudent AS astu WHERE astu.student_id = pt.student_id) 
        ORDER BY ".$columnName." ".$columnSortOrder." 
        LIMIT :limit, :offset";

   $searchCount = "SELECT COUNT(*) AS allcount
                ".$eval_tables."
                WHERE 1 ".$searchQuery." 
                ".$eval_condition;

   $totalCount = "SELECT COUNT(*) AS allcount FROM paidtest AS pt WHERE 1 ".$eval_condition;

}




   // Total number of records without filtering
   $stmt = $conn->prepare($totalCount);
   $stmt->execute();
   $records = $stmt->fetch();
   $totalRecords = $records['allcount'];

   // Total number of records with filtering
   $stmt = $conn->prepare($searchCount);
   $stmt->execute($searchArray);
   $records = $stmt->fetch();
   $totalRecordwithFilter = $records['allcount'];

   // Fetch records
   $stmt = $conn->prepare($sql);

   // Bind values
   foreach ($searchArray as $key=>$search) {
      $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
   }

   $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
   $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
   $stmt->execute();
   $empRecords = $stmt->fetchAll();

   $data = array();

   foreach ($empRecords as $row) {
      $tempData = array();   
      foreach ($columns as $key) {
          if (isset($row[$key])) {
              $tempData[$key] = $row[$key]; 
          } else {
              $tempData[$key] = null; 
          }
      }    
      $data[] = $tempData;
   }

   // Response
   $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
   );

   echo json_encode($response);