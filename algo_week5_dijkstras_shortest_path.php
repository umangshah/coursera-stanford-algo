<?php

$handle = fopen("dijkstraData.txt", "r");

$vertices = array();
$edges = array();
while (($line = fgets($handle)) !== false) {
    $cols = explode("\t", $line);
    $cols[0] = trim($cols[0]);
    $vertices[$cols[0]] = $cols[0];
    $total_edges = count($cols) - 1;

    $edges[$cols[0]] = array();
    for($e=1;$e<=$total_edges;$e++)
    {
        if(isset($cols[$e]) && trim($cols[$e]) != "")
        {
            $edge = explode(",", $cols[$e]);
            $edges[$cols[0]][$edge[0]] = $edge[1];
            
        }
    }
}

$processed_vertices = array(1);
$shortest_path_distances = array(1=>0);
$shortest_paths = array(1=>null);

while(1)
{
    $min = 0;
    $next_vertex = null;
    $source_vertex = null;
    foreach($processed_vertices as $processed_vertex)
    {
        foreach($edges[$processed_vertex] as $dest_vertex => $distance)
        {
            if(!in_array($dest_vertex, $processed_vertices))
            {
                if((($shortest_path_distances[$processed_vertex] + $distance) < $min) || $min == 0)
                {
                    $next_vertex = $dest_vertex;
                    $source_vertex = $processed_vertex;
                    $min = $shortest_path_distances[$processed_vertex] + $distance;
                }
            }
        }
    }

    if($next_vertex == null)
    {
        break;
    }
    $processed_vertices[] = $next_vertex;
    $shortest_path_distances[$next_vertex] = $shortest_path_distances[$source_vertex] + $edges[$source_vertex][$next_vertex];
    $shortest_paths[$next_vertex] = $shortest_paths[$source_vertex]."->".$source_vertex.",".$next_vertex;
}

#print_r($processed_vertices);
#print_r($shortest_path_distances);
#print_r($shortest_paths);

$path_to = array(7,37,59,82,99,115,133,165,188,197);
$answer = '';
foreach($path_to as $destination)
{
    if(isset($shortest_path_distances[$destination]))
    {
        $answer = $answer.",".$shortest_path_distances[$destination];
    }
    else
    {
        $answer = $answer.",1000000";
    }
}

print "Answer is: ".substr($answer,1);