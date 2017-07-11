<?php
$d['khusd_st_follow']['layout'] = "";
$d['khusd_st_follow']['theme'] = "";
$d['khusd_st_follow']['theme_m'] = "";

$d['khusd_st_follow']['FOLLOWER_LIMIT'] = 2;

$d['khusd_st_follow']['FOLLOW_PT']['FOLLOWING'] = 'f';
$d['khusd_st_follow']['FOLLOW_PT']['FREE'] = 'e';

$d['khusd_st_follow']['STATUS']['f'] = 'Following';
$d['khusd_st_follow']['STATUS']['c'] = 'Complete';
$d['khusd_st_follow']['STATUS']['d'] = 'Dropped';

$d['khusd_st_follow']['DEPT'] = array(
    'perio',
    'consv',
    'ortho'
);

$d['khusd_st_follow']['DR'] = array(
    'perio' => array(
                     /* Professors */'허익', '정종혁', '신승윤', '신승일',
                     /* Fellows */ '홍지연',
                     /* R3 */ '김산희', '김행곤', '장미화', '한호철',
                     /* R2 */ '김소정', '김동민', '임현진', '최서연',
                     /* R1 */ '강정화'
                     ),
    'consv' => array(
                     /* Professors */'최경규', '장석우', '김덕수', '이진규',
                     /* R3 */ '우상욱', '채송화', '최진욱', '유승현',
                     /* R2 */ '전봉기', '김보민', '조권', '심현진',
                     /* R1 */ '모소연', '고종건', '김세훈'
                     ),
    'ortho' => array(
                     /* Professors */'박영국', '김수정', '김성훈', '박기호', '안효원',
                     /* Fellows */ '김경아',
                     /* R3 */ '정우영', '김현수', '김현혜', '빈강욱',
                     /* R2 */ '강지인', '안현준', '박홍식', '이원준',
                     /* R1 */ '김강민', '이수현', '서제승', '이정아', '김기방'
                     )
);

$d['khusd_st_follow']['FW_TYPE'] = array(
    'perio' => array('A','B','C'), /* perio */
    'consv' => array('ind', 'rct', 'op'),   /* consv */
    'ortho' => array('new', 'old') /* ortho */
);

?>