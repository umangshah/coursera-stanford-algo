<?php
#Sample input arrays
$integers = file('QuickSort.txt');
#Instead of looping through the array again, we can store it as integer while reading the file
for($i=0;$i<count($integers);$i++)
{
    $integers[$i] = (int) $integers[$i];
}
#$integers = array(4,7,6,20,34,90,23,19);
#$integers = array(2,1,4,3);
#$integers = array(4,80,70,23,9,60,68,27,66,78,12,40,52,53,44,8,49,28,18,46,21,39,51,7,87,99,69,62,84,6,79,67,14,98,83,0,96,5,82,10,26,48,3,2,15,92,11,55,63,97,43,45,81,42,95,20,25,74,24,72,91,35,86,19,75,58,71,47,76,59,64,93,17,50,56,94,90,89,32,37,34,65,1,73,41,36,57,77,30,22,13,29,38,16,88,61,31,85,33,54);
#$integers = array(9, 12, 3, 1, 6, 8, 2, 5, 14, 13, 11, 7, 10, 4, 0);
#$integers = array(37, 7, 2, 14, 35, 47, 10, 24, 44, 17, 34, 11, 16, 48, 1, 39, 6, 33, 43, 26, 40, 4, 28, 5, 38, 41, 42, 12, 13, 21, 29, 18, 3, 19, 0, 32, 46, 27, 31, 25, 15, 36, 20, 8, 9, 49, 22, 23, 30, 45);

#QuickSort - Input array
quickSort($integers, 0, (count($integers)-1));
print "Sorted Array: ";
print_r($integers);

# function - QuickSort
# Input - Array to be sorted, $starting index of the partition, $length of the current partition
function quickSort(&$integers, $start, $length)
{
    static $no_of_comparisons = 0;
     
    #if single element, it is already sorted and return
    if(abs($length - $start) == 0)
    {
        return;
    }
    else
    {
        #no of comparision in this call will be equal to size of the current partition, add it to the total no. of comparision counter 
        $no_of_comparisons += abs($length - $start);
        
        #Q1 - Selecting the first element as the pivot element for the quick sort - no swapping needed here
        $pivot = $start;
        
        #Q2 - Selecting the last element as the pivot element for the quick sort - perform the necessary swap
        #$swap_pivot = $integers[$start];
        #$integers[$start] = $integers[$length];
        #$integers[$length] = $swap_pivot;
        
        #Q3 - Selecting the median element from the first, last and n/2 element - perform the necessary swap
        $middle = (int) (($start+$length)/2); #position of the middle element in the current partition
        #When current partition has only two elements, it doesn't matter which pivot you select - it is going to do one comparision and running time will be same
        if(abs($length - $start) == 1)
        {
            $pivot = $start;
        }
        else
        {
            # Check which is the median element of the three - first, last or middle
            if(($integers[$start] < $integers[$length] && $integers[$start] > $integers[$middle]) || ($integers[$start] > $integers[$length] && $integers[$start] < $integers[$middle]))
            {
                $median_pivot = $start;
            }
            else if(($integers[$length] < $integers[$start] && $integers[$length] > $integers[$middle]) || ($integers[$length] > $integers[$start] && $integers[$length] < $integers[$middle]))
            {
                $median_pivot = $length;
            }
            else
            {
                $median_pivot = $middle;
            }
            #perform the necessary swapping
            $swap_pivot = $integers[$start];
            $integers[$start] = $integers[$median_pivot];
            $integers[$median_pivot] = $swap_pivot;
        }
        
        # as median element has been swapped to the first position, we can select pivot as first element
        $pivot = $start;
        
        # start partitioning 
        $i=$j=$start+1;
        for(;$j<=$length;$j++)
        {
            #if intetger at j is less than pivot, swap it with i and increment i
            if($integers[$j] < $integers[$pivot])
            {
                $temp_value = $integers[$i];
                $integers[$i] = $integers[$j];
                $integers[$j] = $temp_value;
                $i++;
            }
        }
        
        #swap the pivot with i-1 position - this will bring the pivot at it's correct position in the original array
        $temp_value = $integers[$pivot];
        $integers[$pivot] = $integers[$i-1];
        $integers[$i-1] = $temp_value;
        
        # Quick sort left recursive call
        # Condition to check if we found any element that was less than the pivot in the current partition - if not, then no recaursive call needed
        if($i != $start + 1)
        {
            quicksort($integers, $start, $i-2);
        }
        # Quick sort right recursive call
        # if pivot was swapped with the last element or $start+1 was the last element, then no recursive call needed
        if($i < $length)
        {
            quicksort($integers, $i , $length);
        }

        print "No of Comparision - ".$no_of_comparisons."<br />";        
        return;
    }
}

?>
