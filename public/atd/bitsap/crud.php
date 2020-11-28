<?php

include 'dbconnect.php';

/*
Format of CRUD methods ---

get(col,col,....,table_name);

getWhere(col,col,....,table_name,condition_after_where_clause);

insert(
    col-1,value-1,
    col-2,value-2,
    col-3,value-3,
    .
    .
    .
    table_name); 
    // WHERE clause doesnot exist in insert :p

update(
        table_name,
        col-1,value-1,
        col-2,value-2,
        .
        .
        .
        Condition of Where clause   //Must be given
         );

delete(
        table_name,
        where_condition     //Must be given
        );

*/

class crud
{
	private $sql = '';

    private function runQuery($sql,$type='')
    {
        $result = mysqli_query($GLOBALS['db'],$sql);

        if($type == 'get')
        {
            $i=0;
            while ($row = @mysqli_fetch_assoc($result))
            {
                $data_array[$i] = $row;
                $i++;
            }

            if($i>0)
                return $data_array;
            else
                return null;
        }
        else
        {
            if($result)
                return true;
            else
                return false;
        }
    }

	function __call($name_of_function, $value)
	{
              
        // It will match the function name 
        if($name_of_function == 'get')
        {
        	switch (count($value))
        	{
                case 1:
                	$this->sql = "SELECT * from ".$value[0]; 
                    break;

                default: 
                    $n = count($value) - 1;
                    $this->sql = "SELECT ";
                    for ($i=0; $i < $n; $i++)
                    { 
                    	$append = ($i == ($n-1))?' ':',';
                    	$this->sql .= $value[$i].$append;
                    }
                    $this->sql .= "FROM ".$value[$n];
                    break;
            }
            return $this->runQuery($this->sql,'get');
        }

        else if($name_of_function == 'getWhere')
        {
        	switch (count($value))
        	{
                case 2:
                	$this->sql = "SELECT * from ".$value[0]." WHERE ".$value[1];
                    break;

                default: 
                    $n = count($value) - 2;
                    $this->sql = "SELECT ";
                    for ($i=0; $i < $n; $i++)
                    { 
                    	$append = ($i == ($n-1))?' ':',';
                    	$this->sql .= $value[$i].$append;
                    }
                    $this->sql .= "FROM ".$value[$n]." WHERE ".$value[$n+1];
                    break;
            }

            return $this->runQuery($this->sql,'get');
            //return $this->sql;
        }

        else if($name_of_function == 'update')
        {
            $n = count($value);
            $i=1;
        	if($n > 3 && ($n%2 == 0))
        	{
                $this->sql = "UPDATE ".$value[0]." SET ";
                while($i < $n-1)
                {
                    $this->sql .= $value[$i]." = ".$value[$i+1];
                    $i += 2;
                    $append = ($i == ($n-1))?' ':',';
                    $this->sql .= $append;
                }

                $this->sql .= " WHERE ".$value[$n-1];
                return $this->runQuery($this->sql);
            }
        }

        else if($name_of_function == 'insert')
        {
        	if(count($value) >= 3)
        	{
                $n = count($value) - 1;
                $this->sql = "INSERT INTO ".$value[$n]." (";
                $i = 0;
                while ($i<$n)
                {
                    $append = ($i == ($n-2))?' ':',';
                    $this->sql .= $value[$i].$append;
                    $i += 2;
                }
                $this->sql .= ") VALUES (";
                $i = 1;
                while ($i<$n)
                {
                    $append = ($i == ($n-1))?' ':',';
                    $this->sql .= $value[$i].$append;
                    $i += 2;
                }
                $this->sql .= ")";

                return $this->runQuery($this->sql);
                //return $this->sql;
            }
        }
        else if($name_of_function == 'delete')
        {
        	switch (count($value))
        	{
                case 2: 
                    $this->sql = "DELETE FROM ".$value[0]." WHERE ".$value[1];
                break;

                default:
                    return 'Invalid No. of arguments';
                break;
            }
            return $this->runQuery($this->sql);
        }

        else
        	return false;

    }
}

?>