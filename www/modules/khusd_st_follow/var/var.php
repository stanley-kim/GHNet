<?php
$d['khusd_st_follow']['layout'] = "";
$d['khusd_st_follow']['theme'] = "";
$d['khusd_st_follow']['theme_m'] = "";

$d['khusd_st_follow']['FOLLOWER_LIMIT'] = array(
    'perio' => 1,
    'consv' => 1,
    'ortho' => 2
);

$d['khusd_st_follow']['FOLLOW_PT']['FOLLOWING'] = 'f';
$d['khusd_st_follow']['FOLLOW_PT']['FREE'] = 'e';

//$d['khusd_st_follow']['STATUS']['f'] = 'Following';
//$d['khusd_st_follow']['STATUS']['c'] = 'Complete';
//$d['khusd_st_follow']['STATUS']['d'] = 'Dropped';
$d['khusd_st_follow']['STATUS'] = array(
    'f' => 'Following',
    'c' => 'Complete',
    'd' => 'Dropped'
);

$d['khusd_st_follow']['DEPT'] = array(
    'perio',
    'consv',
    'ortho'
);

$d['khusd_st_follow']['DR'] = array(
    'perio' => array(
                     /* Professors */'pf.허익', 'pf.정종혁', 'pf.신승윤', 'pf.신승일',
                     /* Fellows */ 'pf.홍지연', 'pf.임현창',
                     /* R3 */ 'dr.김산희', 'dr.김행곤', 'dr.장미화', 'dr.한호철',
                     /* R2 */ 'dr.김소정', 'dr.김동민', 'dr.임현진', 'dr.최서연',
                     /* R1 */ 'dr.강정화', 'dr.강도욱', 'dr.문정현', 'dr.정지영'
                     ),
    'consv' => array(
                     /* Professors */'pf.최경규', 'pf.장석우', 'pf.김덕수', 'pf.이진규',
                     /* R3 */ 'dr.우상욱', 'dr.채송화', 'dr.최진욱', 'dr.유승현',
                     /* R2 */ 'dr.전봉기', 'dr.김보민', 'dr.조권', 'dr.심현진',
                     /* R1 */ 'dr.모소연', 'dr.고종건', 'dr.김세훈', 'dr.김현정'
                     ),
    'ortho' => array(
                     /* Professors */'pf.박영국', 'pf.김수정', 'pf.김성훈', 'pf.박기호', 'pf.안효원',
                     /* Fellows */ 'pf.김경아',
                     /* R3 */ 'dr.정우영', 'dr.김현수', 'dr.김현혜', 'dr.빈강욱',
                     /* R2 */ 'dr.강지인', 'dr.안현준', 'dr.박홍식', 'dr.이원준',
                     /* R1 */ 'dr.김강민', 'dr.이수연', 'dr.서재승', 'dr.이정아', 'dr.김기방'
                     )
);

$d['khusd_st_follow']['FW_TYPE'] = array(
    'perio' => array('A','B','C'), /* perio */
    'consv' => array(
                     /* indirect */     'ind',
                     /* endo */         'endo-m', 'endo-ap',
                     /* surgery */      'surgery',
                     /* bleaching */    'bleach'
                    ),
    'ortho' => array('new', 'old') /* ortho */
);

$d['khusd_st_follow']['MISC'] = array(
    'consv' => array(
                     /* permanent dentition */ 11,12,13,14,15,16,17,18,21,22,23,24,25,26,27,28,31,32,33,34,35,36,37,38,41,42,43,44,45,46,47,48,
                     /* primary dentition */ 51,52,53,54,55,61,62,63,64,65,71,72,73,74,75,81,82,83,84,85
                    )
);

?>