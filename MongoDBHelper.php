<?php

/*
Author: Ali Nawab
Date: 07-08-2016
*/
class MongoDBHelper
{
    
    public function getClient()
    {
        // connect to mongodb
        $m = new MongoClient();
        return $m;
    }
    
    public function insert($client, $dbname, $collection, $data)
    {
        $db = $client->$dbname;        
        $collection = $db->createCollection($collection);        
        if ($collection->insert($data)) {
		return true;
	}
	return false;
    }
    
    public function getAll($client, $dbname, $collection, $query = null)
    {
        
        // select a database
        $db = $client->$dbname;
        $collection = $db->$collection;        
        $cursor = $collection->find();
        // iterate cursor to display title of documents
        
        foreach ($cursor as $key => $val) {
            echo  $key.' ----- '.print_r($val,true). "<br>";
        }
    }
    
    public function update($client, $dbname, $collection, $query = array(), $set = array())
    {   
        $db         = $client->$dbname;
        $collection = $db->$collection;
        $collection->update($query , $set ));    
        
        // now display the updated document
        $cursor = $collection->find();
        
        // iterate cursor to display title of documents
        foreach ($cursor as $document) {
            echo $document["title"] . "<br>";
        }
    }
    
    public function deleteDocument($client, $dbname, $collection, $query = array())
    {
        
        // select a database
        $db = $client->$dbname; 
        $collection = $db->$collection;
        // now display the available documents
        $cursor = $collection->find();
        foreach ($cursor as $document) {
            echo $document["title"] . "<br>";
        }        
        // now remove the document
        $collection->remove($query, array(
            false
        ));        
        // now display the available documents
        $cursor = $collection->find();
        
        // iterate cursor to display title of documents       
        
        foreach ($cursor as $document) {
            echo $document["title"] . "<br>";
        }
    }
}