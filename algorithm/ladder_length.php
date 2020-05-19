<?php

require_once 'base\AlgorithmBase.php';

//单词接龙-BFS(双向+单向)
class Solution extends \algorithm\base\AlgorithmBase
{	 
	//双向BFS
	function ladderLength($beginWord, $endWord, $wordList) {
		if(!in_array($endWord,$wordList)) return 0;
		$wordKv = array_flip($wordList); // 交换数组中的键和值。查询和删除key比value效率高
		$s1[] = $beginWord;
		$s2[] = $endWord; // 双向BFS
		$n = strlen($beginWord);
		$step = 0;
		while(!empty($s1)){
			$step ++;
			if(count($s1)>count($s2)){//依次双向BFS实现,始终使用变量s1去运算。
				$tmp = $s1;
				$s1 = $s2;
				$s2 = $tmp;
			}
			$s = [];
			foreach($s1 as $word_1){
				for ($i = 0; $i < $n; $i++) {
					$word1 = $word_1;
					for($ch = ord('a'); $ch <= ord('z'); $ch++){
						$word1[$i] = chr($ch);
						if(in_array($word1,$s2)) return $step+1;
						if(!array_key_exists($word1,$wordKv)) continue;
						unset($wordKv[$word1]);
						$s[] = $word1;
					}
				}
			}
			$s1 = $s;
		}
		return 0;
	}
	//单向BFS
    function ladderLength2($beginWord, $endWord, $wordList) {
        $length = strlen($beginWord);
		$all_combo_dict = [];
		foreach($wordList as $word){
			for($i = 0;$i < $length;$i++){
				$all_combo_dict[substr($word,0,$i).'*'.substr($word,$i+1)][]=$word;
			}
		}
		$q = [];
		$q[] = [$beginWord,1];
		$visited = [];
		$visited[$beginWord] =1;
		while(!empty($q)){
			$node = array_shift($q);
			$word=$node[0];
			$level = $node[1];
			for($i = 0;$i < $length;$i++){
				$new_word = substr($word,0,$i).'*'.substr($word,$i+1);
				$word_list = array_key_exists($new_word,$all_combo_dict) ?$all_combo_dict[$new_word] :[];
				foreach($word_list as $check_word){
					if($check_word== $endWord){
						return $level + 1;
					}else{
						if(!isset($visited[$check_word])){
							$visited[$check_word] = 1;
							$q[] =[$check_word,$level+1];
						}
					}
				}
			}
		}
       return 0;
    }
	function test(){
		echo($this->ladderLength2('hit','cog',["hot","dot","dog","lot","log","cog"])).PHP_EOL;
		echo($this->ladderLength2('hit','cog',["hot","dot","dog","lot","log"])).PHP_EOL;
		echo($this->ladderLength2('cet','ism',["kid","tag","pup","ail","tun","woo","erg","luz","brr","gay","sip","kay","per","val","mes","ohs","now","boa","cet","pal","bar","die","war","hay","eco","pub","lob","rue","fry","lit","rex","jan","cot","bid","ali","pay","col","gum","ger","row","won","dan","rum","fad","tut","sag","yip","sui","ark","has","zip","fez","own","ump","dis","ads","max","jaw","out","btu","ana","gap","cry","led","abe","box","ore","pig","fie","toy","fat","cal","lie","noh","sew","ono","tam","flu","mgm","ply","awe","pry","tit","tie","yet","too","tax","jim","san","pan","map","ski","ova","wed","non","wac","nut","why","bye","lye","oct","old","fin","feb","chi","sap","owl","log","tod","dot","bow","fob","for","joe","ivy","fan","age","fax","hip","jib","mel","hus","sob","ifs","tab","ara","dab","jag","jar","arm","lot","tom","sax","tex","yum","pei","wen","wry","ire","irk","far","mew","wit","doe","gas","rte","ian","pot","ask","wag","hag","amy","nag","ron","soy","gin","don","tug","fay","vic","boo","nam","ave","buy","sop","but","orb","fen","paw","his","sub","bob","yea","oft","inn","rod","yam","pew","web","hod","hun","gyp","wei","wis","rob","gad","pie","mon","dog","bib","rub","ere","dig","era","cat","fox","bee","mod","day","apr","vie","nev","jam","pam","new","aye","ani","and","ibm","yap","can","pyx","tar","kin","fog","hum","pip","cup","dye","lyx","jog","nun","par","wan","fey","bus","oak","bad","ats","set","qom","vat","eat","pus","rev","axe","ion","six","ila","lao","mom","mas","pro","few","opt","poe","art","ash","oar","cap","lop","may","shy","rid","bat","sum","rim","fee","bmw","sky","maj","hue","thy","ava","rap","den","fla","auk","cox","ibo","hey","saw","vim","sec","ltd","you","its","tat","dew","eva","tog","ram","let","see","zit","maw","nix","ate","gig","rep","owe","ind","hog","eve","sam","zoo","any","dow","cod","bed","vet","ham","sis","hex","via","fir","nod","mao","aug","mum","hoe","bah","hal","keg","hew","zed","tow","gog","ass","dem","who","bet","gos","son","ear","spy","kit","boy","due","sen","oaf","mix","hep","fur","ada","bin","nil","mia","ewe","hit","fix","sad","rib","eye","hop","haw","wax","mid","tad","ken","wad","rye","pap","bog","gut","ito","woe","our","ado","sin","mad","ray","hon","roy","dip","hen","iva","lug","asp","hui","yak","bay","poi","yep","bun","try","lad","elm","nat","wyo","gym","dug","toe","dee","wig","sly","rip","geo","cog","pas","zen","odd","nan","lay","pod","fit","hem","joy","bum","rio","yon","dec","leg","put","sue","dim","pet","yaw","nub","bit","bur","sid","sun","oil","red","doc","moe","caw","eel","dix","cub","end","gem","off","yew","hug","pop","tub","sgt","lid","pun","ton","sol","din","yup","jab","pea","bug","gag","mil","jig","hub","low","did","tin","get","gte","sox","lei","mig","fig","lon","use","ban","flo","nov","jut","bag","mir","sty","lap","two","ins","con","ant","net","tux","ode","stu","mug","cad","nap","gun","fop","tot","sow","sal","sic","ted","wot","del","imp","cob","way","ann","tan","mci","job","wet","ism","err","him","all","pad","hah","hie","aim","ike","jed","ego","mac","baa","min","com","ill","was","cab","ago","ina","big","ilk","gal","tap","duh","ola","ran","lab","top","gob","hot","ora","tia","kip","han","met","hut","she","sac","fed","goo","tee","ell","not","act","gil","rut","ala","ape","rig","cid","god","duo","lin","aid","gel","awl","lag","elf","liz","ref","aha","fib","oho","tho","her","nor","ace","adz","fun","ned","coo","win","tao","coy","van","man","pit","guy","foe","hid","mai","sup","jay","hob","mow","jot","are","pol","arc","lax","aft","alb","len","air","pug","pox","vow","got","meg","zoe","amp","ale","bud","gee","pin","dun","pat","ten","mob"])).PHP_EOL;

	}
}

(new Solution())->test();