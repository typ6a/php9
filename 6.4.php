<?php

$arr = [
    [0,0,1,0],
    [1,0,0,0],
    [1,1,1,0],
    [1,1,1,0]
];

$pos = [0,0];
$end = [3,3];

$direction = 'down';

start($arr, $pos, $direction);

function start($arr, $pos, $direction) {
    print_r(getMoves($arr, $pos));
    print_r(getRightHand($arr, $pos, $direction));
    
}

function getMoves($arr, $pos) {
    $x = $pos[1];
    $y = $pos[0];
    $around = [];
    $around['up']    = isset($arr[$x][$y - 1]) ? ['x' => $x, 'y' => $y - 1, 'val' => $arr[$y - 1][$x]] : false;
    $around['down']  = isset($arr[$x][$y + 1]) ? ['x' => $x, 'y' => $y + 1, 'val' => $arr[$y + 1][$x]] : false;
    $around['left']  = isset($arr[$x - 1][$y]) ? ['x' => $x - 1, 'y' => $y, 'val' => $arr[$y][$x - 1]] : false;
    $around['right'] = isset($arr[$x + 1][$y]) ? ['x' => $x + 1, 'y' => $y, 'val' => $arr[$y][$x + 1]] : false;
    return $around;
}

function changeDirection($arr, $pos, &$direction) {
    while (getRightHand($arr, $pos, $direction != 0)) {
        turn($direction);
    }
    turn($direction);
    // print_r($direction);
    return $direction;
}

function getRightHand($arr, $pos, $direction) {
    $around = getMoves($arr, $pos);
    if ($direction == 'down') {
        $rightHand = $around['left'];
    }
    if ($direction == 'up') {
        $rightHand = $around['right'];
    }
    if ($direction == 'left') {
        $rightHand = $around['up'];
    }
    if ($direction == 'right') {
        $rightHand = $around['down'];
    }
    return $rightHand;
}


// function selectDirection($arr, $pos) {
//     $directions =['up', 'down', 'left', 'right'];
//         // print_r(getRightHand($arr, $pos, $directions[0]));
//     for ($i=0; $i < count($directions); $i++) { 
//         $rightHand =getRightHand($arr, $pos, $directions[$i]);
//         // print_r($rightHand);
//         if ($rightHand['val'] == 0) {

//             return turn($directions[$i]);
//         }
//     }
// }

function move(&$arr, &$pos, $direction) {
    $direction = changeDirection($arr, $pos, $direction);
    print_r($direction . 'after move');
    $nextCoordinates = [];
    
    if ($direction == 'up') {
        $nextCoordinates[0] = $pos[0] - 1;
        $nextCoordinates[1] = $pos[1];
    }
    if ($direction == 'down') {
        $nextCoordinates[0] = $pos[0] + 1;
        $nextCoordinates[1] = $pos[1];
    }
    if ($direction == 'left') {
        $nextCoordinates[0] = $pos[0];
        $nextCoordinates[1] = $pos[1] - 1;
    }
    if ($direction == 'right') {
        $nextCoordinates[0] = $pos[0];
        $nextCoordinates[1] = $pos[1] + 1;
    }
    $arr[$pos[0]][$pos[1]] = 2;
    $nextCoordinates['val'] = $arr[$nextCoordinates[0]][$nextCoordinates[1]];
    $pos[0] = $nextCoordinates[0];
    $pos[1] = $nextCoordinates[1];
    return $pos = $nextCoordinates;
}


    // foreach ($directions as $direction) {
    //     foreach (getRightHand($arr, $pos, $direction) as $rightHand) {
    //         if ($rightHand[$direction]['val'] == 0) {
    //             return $direction;
    //         }
    //     }
    // }



function turn(&$direction) {
    if ($direction == 'up') {
        return $direction = 'right';
    }
    elseif ($direction == 'down') {
        return $direction = 'left';
    }
    elseif ($direction == 'left') {
        return $direction = 'up';
    }
    elseif ($direction == 'right') {
        return $direction = 'down';
    }
    return 'wrong direction!';

}


// // print_r(nextCoordinates([0, 0], 'down', $start));
// print_r(selectDirection($arr, $start, $direction));


