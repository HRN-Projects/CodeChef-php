<?php

    function get_dynm($str)                     // Function 'get_dynm' to get string as an input and processing for that string.
    {
        $strArr = str_split(strtolower($str));      // Storing the string given in an array 'strArr'.
        $strCount = count($strArr);                 // Count of 'strArr'.
        
        $charArr = array();                         /* Decalring an array to store individual letters identified
                                                    from the given string.*/
        $charIndx = 0;                              // Initializing variable as index for 'charArr'.
                
        $charFlag = array();                        /* Decalring an array of flags for preventing re-scan of 
                                                    repeated letter, if that letter group is already scanned. 
                                                    Change the flag for the respective letter to '1'. */

        $freqArr = array();                         /* Declaring an array to store frequncy of scanned 
                                                    letters in 'freqArr'.*/
        $freq = 0;                                  // Initializing variable of frequecy from zero.


        // Loop 1 : Loop to find and store individual letters from string in an array 'charArr'
        for ($a = 0; $a < $strCount; $a++)
        {
            if((($a == ($strCount - 1)) || ($strArr[$a] != $strArr[$a + 1])) && (!in_array($strArr[$a], $charArr))) 
            {
                $charArr[$charIndx] = $strArr[$a];
                $charIndx++;
            }
        }
        
  
        $charCount = count($charArr);               // Count of 'charArr'.
        
        if(($charCount-1) < 3)
        {
            return true;
        }
  
  
        /* Loop 2 : Initialization of flags for all the individual letters identified in Loop 1, keeping flag values in 'charFlag' array.*/
        for($flags=0; $flags < $charCount; $flags++)
        {
            $charFlag[$flags] = 0;
        }

        
        // Loop 3 : Loop to get frequency of the individual characters from string and keeping them in 'freqArr' array.
        for($b = 0; $b < $charCount; $b++)
        {
            for($c = 0; $c < $strCount; $c++)
            {
                if(($charArr[$b] == $strArr[$c]) && ($charFlag[$b] == 0))
                {
                    $freqArr[$b] = ++$freq;

                    if(($c == ($strCount - 1)) || ($charArr[$b] != $strArr[$c + 1]))
                    {
                        $charFlag[$b] = 1;
                    }
                }
            }
            $freq = 0;
        }
        
        
        // Loop 4 : This is to equate the sum of next two letters' frequency with current letter's frequency.
        for ($x = 0; $x < (count($freqArr) - 2); $x++)      
        {
            if($freqArr[$x] == ( ($freqArr[$x + 1]) + ($freqArr[$x + 2]) ))
            {
                return 'true';
            }
        }
    }


    // if frequency of current letter is equal to sum of frequency of next two letters then print 'Dynamic' else print 'Not'
    // f(letter1) = f(letter2) + f(letter3), f = frequency.
    while($str1 = fgets(STDIN))
    {
        $inpArr = explode(PHP_EOL,$str1, 1);

        if(preg_match("/\d/", $str1))
        {
            $str1 = (int)$str1;
        }

        if((!is_numeric($str1)) && (get_dynm($str1)))  
        {
            echo 'Dynamic'."\n";
        }   
        elseif((!is_numeric($str1)) && (!get_dynm($str1)))
        {
            echo 'Not'."\n";
        }   
    }
?>