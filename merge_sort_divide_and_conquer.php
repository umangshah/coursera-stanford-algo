<?php 
$lines = file('IntegerArray.txt');
#$lines = array(120,30,55,22,49,16);
#$lines = array(1,3,5,2,4,6);
#$lines = array(4,80,70,23,9,60,68,27,66,78,12,40,52,53,44,8,49,28,18,46,21,39,51,7,87,99,69,62,84,6,79,67,14,98,83,0,96,5,82,10,26,48,3,2,15,92,11,55,63,97,43,45,81,42,95,20,25,74,24,72,91,35,86,19,75,58,71,47,76,59,64,93,17,50,56,94,90,89,32,37,34,65,1,73,41,36,57,77,30,22,13,29,38,16,88,61,31,85,33,54);
#$lines = array(9, 12, 3, 1, 6, 8, 2, 5, 14, 13, 11, 7, 10, 4, 0);
#$lines = array(37, 7, 2, 14, 35, 47, 10, 24, 44, 17, 34, 11, 16, 48, 1, 39, 6, 33, 43, 26, 40, 4, 28, 5, 38, 41, 42, 12, 13, 21, 29, 18, 3, 19, 0, 32, 46, 27, 31, 25, 15, 36, 20, 8, 9, 49, 22, 23, 30, 45);

$sorted_array = mergeSort($lines);
print "Sorted Array: ";
print_r($sorted_array);

function mergeSort($integers)
{
    if(count($integers) == 1)
    {
        return array($integers[0]);
    }
    else
    {
        #divide the sub problem - split the input array into half
        $total_length = count($integers);
        $half_length = (int) (count($integers)/2);
        $first_half = array();
        for($i=0;$i<$half_length;$i++)
        {
            $first_half[] = (int) $integers[$i];
        }

        $second_half = array();
        for($i=$half_length;$i<$total_length;$i++)
        {
            $second_half[] = (int) $integers[$i];
        }   
        
        #conquer the sub problem - sort the left array and right array
        $sorted_first_half = mergeSort($first_half);
        $sorted_second_half = mergeSort($second_half);
        
        #combine solution of subproblem -  take two sorted array and produce a merged sorted array
        $merged_array = sortMerge($sorted_first_half, $sorted_second_half);
        return $merged_array;
    }
}

function sortMerge($sorted_first_half, $sorted_second_half)
{
    $length_first_half = count($sorted_first_half);
    
    $length_second_half = count($sorted_second_half);

    $total_length = $length_first_half + $length_second_half;
    $f_i = $s_i = 0;
    $sorted_merged_array = array();
    for($i=0;$i<$total_length;)
    {
        if(!isset($sorted_first_half[$f_i]))
        {
            $sorted_merged_array[$i++] = $sorted_second_half[$s_i++]; 
        }
        else if(!isset($sorted_second_half[$s_i]))
        {
            $sorted_merged_array[$i++] = $sorted_first_half[$f_i++];
        }
        else if($sorted_first_half[$f_i] > $sorted_second_half[$s_i])
        {
            $sorted_merged_array[$i++] = $sorted_second_half[$s_i++];
        }
        else if($sorted_second_half[$s_i] >= $sorted_first_half[$f_i])
        {
            $sorted_merged_array[$i++] = $sorted_first_half[$f_i++];
        }
    }
    return $sorted_merged_array;
}

?>
