<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
include '../../algorithm/anagramAlgorithm.php';



class databaseController extends Controller
{


    function readWordsToDictionary($url): array
    {
        $file = file($url);
        $wordsDictionary=[];
        foreach ($file as $word){
            if (preg_match('~[0-9]+~', $word)) {
                continue;
            }else{
                $word = trim($word);

                $wordLength = strlen(str_replace("-", "",$word));
                $wordsDictionary[$word]=$wordLength;
            }

        }

        return $wordsDictionary;


    }
    public function insertWordsToDB(Request $request) {

        $url = $request->input('dataBaseLink');
        $wordDictionary = $this->readWordsToDictionary($url);

        set_time_limit(0);

        foreach ($wordDictionary as $key=>$value){
            $word = $key;
            $word_length = $value;
            DB::insert('insertWordsToDB into words (word, wordLength) values (?, ?)', [$word, $word_length]);

        }

        return response()->json(['status'=>'success', 'msg'=>"WORDS added"]);

    }

    function findWordsByLength($wordLength): ?array{

        $matchingLengthWords = [];


        $results = DB::select('select * from words where wordLength = (?)', [$wordLength]);

        if ($results === null){
            return [];
        }


        foreach ($results as $row){

            $matchingLengthWords[] =$row->word;
        }



        return $matchingLengthWords;

    }

    function findAnagram(Request $request){

        $word = $request->input('word');
        $matchingLenghtWords = $this->findWordsByLength(strlen($word));
        $anagrams = [];


        if (count($matchingLenghtWords)===0){
            return response()->json(['msg'=>"NO matches"]);
        }

        foreach ($matchingLenghtWords as $anagram){
//            if ($this->isAnagram($word, $anagram)){
//                $anagrams[] = $anagram;
//            }
            if (isAnagram($word, $anagram)){
                $anagrams[] = $anagram;
            }

        }
        if (count($anagrams)===0){
            return response()->json(['msg'=>"NO matches"]);
        }
        else{

            return response()->json($anagrams);
        }

    }


//    function isAnagram($string_1, $string_2) : bool
//    {
//        $string_1 = strtolower($string_1);
//        $string_2 = strtolower($string_2);
//        $string_11 = str_replace("-", "",$string_1);
//        $string_22 = str_replace("-", "",$string_2);
//
//
//
//        if (count_chars($string_11, 1) == count_chars($string_22, 1)){
//
//            return true;
//        }
//        else{
//            return false;
//        }
//
//    }

}
