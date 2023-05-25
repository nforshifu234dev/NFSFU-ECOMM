<?php include_once "assets/php/app.php" ?>

<?php
if ( chechkSiteVisibilityStatus($dbConn) === 1 ){

} else
if ( chechkSiteVisibilityStatus($dbConn) != 3 )
{
    header("location: index.php");
}


?>

<?php require_once 'assets/pages/head.php' ?>

    <title><?php echo $site_titile ?> - Home</title>

    <style>

        .top 
        {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        .top svg
        {
            transform: rotate(180deg);
        }

        .bottom 
        {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .bottom svg
        {
            fill: red;
        }
        .contents
        {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>

</head>
<body>
    
    <div class="container-fluid">

        <?php require_once 'assets/pages/navigation.php' ?>


        <div class="contents container-fluid"  >
            

            <div class="page-contents w-100" style="height: 85vh;overflow:hidden;">

                <div class="page-not-found-container h-100">

                    <div class="title text-center h-100">
                        
                        <div class="w-100" style="position:relative;height: 100%;">

                            <div class="top">
                            <svg width='100%' height='100%' id='svg' viewBox='0 0 1440 500' xmlns='http://www.w3.org/2000/svg' class='transition duration-300 ease-in-out delay-150'><style>.path-0{
            animation:pathAnim-0 4s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
          }
          @keyframes pathAnim-0{
            0%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 42.90862830103889,184.92245367310795 85.81725660207778,203.84490734621588 130,203 C 174.18274339792222,202.15509265378412 219.63960189272785,181.5428242882445 277,163 C 334.36039810727215,144.4571757117555 403.62433582701107,127.98379550080625 451,128 C 498.37566417298893,128.01620449919375 523.863054799228,144.5219937085305 564,153 C 604.136945200772,161.4780062914695 658.9234449760766,161.92822966507174 717,147 C 775.0765550239234,132.07177033492826 836.4431652964657,101.76508763118244 888,123 C 939.5568347035343,144.23491236881756 981.3038938380607,217.01141981019853 1019,211 C 1056.6961061619393,204.98858018980147 1090.3412593512915,120.18923312802349 1135,108 C 1179.6587406487085,95.81076687197651 1235.331068756774,156.23164767770757 1288,178 C 1340.668931243226,199.76835232229243 1390.3344656216132,182.88417616114623 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            25%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 49.94224008036163,175.42742340532396 99.88448016072326,184.8548468106479 141,197 C 182.11551983927674,209.1451531893521 214.40431943746864,224.0080361627323 264,213 C 313.59568056253136,201.9919638372677 380.4982420894023,165.1130085384229 428,167 C 475.5017579105977,168.8869914615771 503.6027122049222,209.53992968357608 556,210 C 608.3972877950778,210.46007031642392 685.090909090909,170.72727272727275 731,169 C 776.909090909091,167.27272727272725 792.0336514314414,203.550979407333 839,224 C 885.9663485685586,244.449020592667 964.7744851833249,249.06880964339533 1023,229 C 1081.225514816675,208.93119035660467 1118.8684078352587,164.17378201908588 1167,156 C 1215.1315921647413,147.82621798091412 1273.7518834756404,176.2360622802612 1321,184 C 1368.2481165243596,191.7639377197388 1404.12405826218,178.8819688598694 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            50%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 38.98449602157075,207.03028100134816 77.9689920431415,248.06056200269634 133,225 C 188.0310079568585,201.93943799730366 259.1085278490048,114.78803299056281 304,109 C 348.8914721509952,103.21196700943719 367.5968965608395,178.78730603505244 409,211 C 450.4031034391605,243.21269396494756 514.503885907637,232.06274286922732 565,217 C 615.496114092363,201.93725713077268 652.3875598086125,182.96172248803828 702,174 C 751.6124401913875,165.03827751196172 813.9458748579133,166.0903671786196 860,182 C 906.0541251420867,197.9096328213804 935.8289407597345,228.6768087974834 981,228 C 1026.1710592402655,227.3231912025166 1086.7383621031483,195.20239763144676 1147,183 C 1207.2616378968517,170.79760236855324 1267.217610827672,178.5136006767295 1316,179 C 1364.782389172328,179.4863993232705 1402.3911945861641,172.74319966163523 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            75%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 38.51858362631843,176.5366649924661 77.03716725263686,187.07332998493217 119,186 C 160.96283274736314,184.92667001506783 206.369914615771,172.24334505273734 268,156 C 329.630085384229,139.75665494726266 407.48317428427924,119.95328980411855 457,122 C 506.51682571572076,124.04671019588145 527.6973882471121,147.94349573078853 568,163 C 608.3026117528879,178.05650426921147 667.7272727272727,184.27272727272728 726,168 C 784.2727272727273,151.72727272727272 841.393520843797,112.96559517830237 885,116 C 928.606479156203,119.03440482169763 958.6986438975391,163.8648920140633 996,162 C 1033.3013561024609,160.1351079859367 1077.811903566047,111.5748367654445 1131,124 C 1184.188096433953,136.4251632345555 1246.0537418382723,209.8357609241587 1299,227 C 1351.9462581617277,244.1642390758413 1395.9731290808638,205.08211953792065 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            100%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 42.90862830103889,184.92245367310795 85.81725660207778,203.84490734621588 130,203 C 174.18274339792222,202.15509265378412 219.63960189272785,181.5428242882445 277,163 C 334.36039810727215,144.4571757117555 403.62433582701107,127.98379550080625 451,128 C 498.37566417298893,128.01620449919375 523.863054799228,144.5219937085305 564,153 C 604.136945200772,161.4780062914695 658.9234449760766,161.92822966507174 717,147 C 775.0765550239234,132.07177033492826 836.4431652964657,101.76508763118244 888,123 C 939.5568347035343,144.23491236881756 981.3038938380607,217.01141981019853 1019,211 C 1056.6961061619393,204.98858018980147 1090.3412593512915,120.18923312802349 1135,108 C 1179.6587406487085,95.81076687197651 1235.331068756774,156.23164767770757 1288,178 C 1340.668931243226,199.76835232229243 1390.3344656216132,182.88417616114623 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
          }</style><defs><linearGradient id='gradient' x1='0%' y1='50%' x2='100%' y2='50%'><stop offset='5%' stop-color='#7bdcb5'></stop><stop offset='95%' stop-color='#abb8c3'></stop></linearGradient></defs><path d='M 0,500 C 0,500 0,166 0,166 C 42.90862830103889,184.92245367310795 85.81725660207778,203.84490734621588 130,203 C 174.18274339792222,202.15509265378412 219.63960189272785,181.5428242882445 277,163 C 334.36039810727215,144.4571757117555 403.62433582701107,127.98379550080625 451,128 C 498.37566417298893,128.01620449919375 523.863054799228,144.5219937085305 564,153 C 604.136945200772,161.4780062914695 658.9234449760766,161.92822966507174 717,147 C 775.0765550239234,132.07177033492826 836.4431652964657,101.76508763118244 888,123 C 939.5568347035343,144.23491236881756 981.3038938380607,217.01141981019853 1019,211 C 1056.6961061619393,204.98858018980147 1090.3412593512915,120.18923312802349 1135,108 C 1179.6587406487085,95.81076687197651 1235.331068756774,156.23164767770757 1288,178 C 1340.668931243226,199.76835232229243 1390.3344656216132,182.88417616114623 1440,166 C 1440,166 1440,500 1440,500 Z' stroke='none' stroke-width='0' fill='transparent' fill-opacity='0.53' class='transition-all duration-300 ease-in-out delay-150 path-0'></path><style>.path-1{
            animation:pathAnim-1 4s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
          }
          @keyframes pathAnim-1{
            0%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 55.30877104866636,338.281014565545 110.61754209733272,343.5620291310899 164,356 C 217.38245790266728,368.4379708689101 268.83860265933544,388.0328980411853 310,385 C 351.16139734066456,381.9671019588147 382.02804726532554,356.30637870416876 419,353 C 455.97195273467446,349.69362129583124 499.04920827936246,368.7415871421396 560,368 C 620.9507917206375,367.2584128578604 699.7751196172248,346.7272727272727 745,344 C 790.2248803827752,341.2727272727273 801.850313251738,356.3493219487695 840,355 C 878.149686748262,353.6506780512305 942.8236273758228,335.8754394776494 1003,343 C 1063.1763726241772,350.1245605223506 1118.8551772449707,382.1489201406328 1163,393 C 1207.1448227550293,403.8510798593672 1239.7556636442941,393.5288799598192 1284,380 C 1328.2443363557059,366.4711200401808 1384.122168177853,349.73556002009036 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            25%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 33.302955404583784,353.49044383938246 66.60591080916757,373.980887678765 123,363 C 179.39408919083243,352.019112321235 258.87931216791355,309.56689312432263 307,284 C 355.12068783208645,258.43310687567737 371.8768405191785,249.75153982394465 414,280 C 456.1231594808215,310.24846017605535 523.6133257553728,379.426947579899 585,388 C 646.3866742446272,396.573052420101 701.66985645933,344.5406698564593 740,328 C 778.33014354067,311.4593301435407 799.7072484073067,330.41037299426364 839,333 C 878.2927515926933,335.58962700573636 935.5011499114437,321.817838166486 999,323 C 1062.4988500885563,324.182161833514 1132.288151946919,340.31827433979225 1177,354 C 1221.711848053081,367.68172566020775 1241.3462423008802,378.9090644743451 1281,375 C 1320.6537576991198,371.0909355256549 1380.3268788495598,352.04546776282746 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            50%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 50.380210949271714,303.924304105316 100.76042189854343,274.84860821063205 151,298 C 201.23957810145657,321.15139178936795 251.33852335509795,396.5298712627878 293,394 C 334.66147664490205,391.4701287372122 367.88548468106484,311.0319067382167 412,292 C 456.11451531893516,272.9680932617833 511.119537920643,315.3425017843453 570,340 C 628.880462079357,364.6574982156547 691.6363636363635,371.5980861244019 746,378 C 800.3636363636365,384.4019138755981 846.3350075339025,390.26515371804703 881,392 C 915.6649924660975,393.73484628195297 939.0236062280262,391.3412990034101 988,380 C 1036.9763937719738,368.6587009965899 1111.570567553993,348.3696502683127 1171,337 C 1230.429432446007,325.6303497316873 1274.6941235560018,323.1800999233392 1317,324 C 1359.3058764439982,324.8199000766608 1399.6529382219992,328.9099500383304 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            75%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 38.341470829257986,306.8781093869783 76.68294165851597,280.7562187739565 129,288 C 181.31705834148403,295.2437812260435 247.60970419519413,335.85323429115226 295,354 C 342.3902958048059,372.14676570884774 370.8782415607074,367.83084406143433 415,370 C 459.1217584392926,372.16915593856567 518.8773295619762,380.8233894631103 571,374 C 623.1226704380238,367.1766105368897 667.6124401913876,344.8755980861244 718,348 C 768.3875598086124,351.1244019138756 824.6729096724735,379.67421819239206 872,391 C 919.3270903275265,402.32578180760794 957.6959211187184,396.4275291443073 1006,382 C 1054.3040788812816,367.5724708556927 1112.5434058526528,344.6156652303788 1155,346 C 1197.4565941473472,347.3843347696212 1224.1304554706705,373.1098099341775 1269,375 C 1313.8695445293295,376.8901900658225 1376.9347722646648,354.94509503291124 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            100%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 55.30877104866636,338.281014565545 110.61754209733272,343.5620291310899 164,356 C 217.38245790266728,368.4379708689101 268.83860265933544,388.0328980411853 310,385 C 351.16139734066456,381.9671019588147 382.02804726532554,356.30637870416876 419,353 C 455.97195273467446,349.69362129583124 499.04920827936246,368.7415871421396 560,368 C 620.9507917206375,367.2584128578604 699.7751196172248,346.7272727272727 745,344 C 790.2248803827752,341.2727272727273 801.850313251738,356.3493219487695 840,355 C 878.149686748262,353.6506780512305 942.8236273758228,335.8754394776494 1003,343 C 1063.1763726241772,350.1245605223506 1118.8551772449707,382.1489201406328 1163,393 C 1207.1448227550293,403.8510798593672 1239.7556636442941,393.5288799598192 1284,380 C 1328.2443363557059,366.4711200401808 1384.122168177853,349.73556002009036 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
          }</style><defs><linearGradient id='gradient' x1='0%' y1='50%' x2='100%' y2='50%'><stop offset='5%' stop-color='#7bdcb5'></stop><stop offset='95%' stop-color='#abb8c3'></stop></linearGradient></defs><path d='M 0,500 C 0,500 0,333 0,333 C 55.30877104866636,338.281014565545 110.61754209733272,343.5620291310899 164,356 C 217.38245790266728,368.4379708689101 268.83860265933544,388.0328980411853 310,385 C 351.16139734066456,381.9671019588147 382.02804726532554,356.30637870416876 419,353 C 455.97195273467446,349.69362129583124 499.04920827936246,368.7415871421396 560,368 C 620.9507917206375,367.2584128578604 699.7751196172248,346.7272727272727 745,344 C 790.2248803827752,341.2727272727273 801.850313251738,356.3493219487695 840,355 C 878.149686748262,353.6506780512305 942.8236273758228,335.8754394776494 1003,343 C 1063.1763726241772,350.1245605223506 1118.8551772449707,382.1489201406328 1163,393 C 1207.1448227550293,403.8510798593672 1239.7556636442941,393.5288799598192 1284,380 C 1328.2443363557059,366.4711200401808 1384.122168177853,349.73556002009036 1440,333 C 1440,333 1440,500 1440,500 Z' stroke='none' stroke-width='0' fill='black' fill-opacity='1' class='transition-all duration-300 ease-in-out delay-150 path-1'></path></svg>
                            </div>

                            <div class="bottom">
                            <svg width='100%' height='100%' id='svg' viewBox='0 0 1440 500' xmlns='http://www.w3.org/2000/svg' class='transition duration-300 ease-in-out delay-150'><style>.path-0{
            animation:pathAnim-0 4s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
          }
          @keyframes pathAnim-0{
            0%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 42.90862830103889,184.92245367310795 85.81725660207778,203.84490734621588 130,203 C 174.18274339792222,202.15509265378412 219.63960189272785,181.5428242882445 277,163 C 334.36039810727215,144.4571757117555 403.62433582701107,127.98379550080625 451,128 C 498.37566417298893,128.01620449919375 523.863054799228,144.5219937085305 564,153 C 604.136945200772,161.4780062914695 658.9234449760766,161.92822966507174 717,147 C 775.0765550239234,132.07177033492826 836.4431652964657,101.76508763118244 888,123 C 939.5568347035343,144.23491236881756 981.3038938380607,217.01141981019853 1019,211 C 1056.6961061619393,204.98858018980147 1090.3412593512915,120.18923312802349 1135,108 C 1179.6587406487085,95.81076687197651 1235.331068756774,156.23164767770757 1288,178 C 1340.668931243226,199.76835232229243 1390.3344656216132,182.88417616114623 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            25%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 49.94224008036163,175.42742340532396 99.88448016072326,184.8548468106479 141,197 C 182.11551983927674,209.1451531893521 214.40431943746864,224.0080361627323 264,213 C 313.59568056253136,201.9919638372677 380.4982420894023,165.1130085384229 428,167 C 475.5017579105977,168.8869914615771 503.6027122049222,209.53992968357608 556,210 C 608.3972877950778,210.46007031642392 685.090909090909,170.72727272727275 731,169 C 776.909090909091,167.27272727272725 792.0336514314414,203.550979407333 839,224 C 885.9663485685586,244.449020592667 964.7744851833249,249.06880964339533 1023,229 C 1081.225514816675,208.93119035660467 1118.8684078352587,164.17378201908588 1167,156 C 1215.1315921647413,147.82621798091412 1273.7518834756404,176.2360622802612 1321,184 C 1368.2481165243596,191.7639377197388 1404.12405826218,178.8819688598694 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            50%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 38.98449602157075,207.03028100134816 77.9689920431415,248.06056200269634 133,225 C 188.0310079568585,201.93943799730366 259.1085278490048,114.78803299056281 304,109 C 348.8914721509952,103.21196700943719 367.5968965608395,178.78730603505244 409,211 C 450.4031034391605,243.21269396494756 514.503885907637,232.06274286922732 565,217 C 615.496114092363,201.93725713077268 652.3875598086125,182.96172248803828 702,174 C 751.6124401913875,165.03827751196172 813.9458748579133,166.0903671786196 860,182 C 906.0541251420867,197.9096328213804 935.8289407597345,228.6768087974834 981,228 C 1026.1710592402655,227.3231912025166 1086.7383621031483,195.20239763144676 1147,183 C 1207.2616378968517,170.79760236855324 1267.217610827672,178.5136006767295 1316,179 C 1364.782389172328,179.4863993232705 1402.3911945861641,172.74319966163523 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            75%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 38.51858362631843,176.5366649924661 77.03716725263686,187.07332998493217 119,186 C 160.96283274736314,184.92667001506783 206.369914615771,172.24334505273734 268,156 C 329.630085384229,139.75665494726266 407.48317428427924,119.95328980411855 457,122 C 506.51682571572076,124.04671019588145 527.6973882471121,147.94349573078853 568,163 C 608.3026117528879,178.05650426921147 667.7272727272727,184.27272727272728 726,168 C 784.2727272727273,151.72727272727272 841.393520843797,112.96559517830237 885,116 C 928.606479156203,119.03440482169763 958.6986438975391,163.8648920140633 996,162 C 1033.3013561024609,160.1351079859367 1077.811903566047,111.5748367654445 1131,124 C 1184.188096433953,136.4251632345555 1246.0537418382723,209.8357609241587 1299,227 C 1351.9462581617277,244.1642390758413 1395.9731290808638,205.08211953792065 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
            100%{
              d: path('M 0,500 C 0,500 0,166 0,166 C 42.90862830103889,184.92245367310795 85.81725660207778,203.84490734621588 130,203 C 174.18274339792222,202.15509265378412 219.63960189272785,181.5428242882445 277,163 C 334.36039810727215,144.4571757117555 403.62433582701107,127.98379550080625 451,128 C 498.37566417298893,128.01620449919375 523.863054799228,144.5219937085305 564,153 C 604.136945200772,161.4780062914695 658.9234449760766,161.92822966507174 717,147 C 775.0765550239234,132.07177033492826 836.4431652964657,101.76508763118244 888,123 C 939.5568347035343,144.23491236881756 981.3038938380607,217.01141981019853 1019,211 C 1056.6961061619393,204.98858018980147 1090.3412593512915,120.18923312802349 1135,108 C 1179.6587406487085,95.81076687197651 1235.331068756774,156.23164767770757 1288,178 C 1340.668931243226,199.76835232229243 1390.3344656216132,182.88417616114623 1440,166 C 1440,166 1440,500 1440,500 Z');
            }
          }</style><defs><linearGradient id='gradient' x1='0%' y1='50%' x2='100%' y2='50%'><stop offset='5%' stop-color='#7bdcb5'></stop><stop offset='95%' stop-color='#abb8c3'></stop></linearGradient></defs><path d='M 0,500 C 0,500 0,166 0,166 C 42.90862830103889,184.92245367310795 85.81725660207778,203.84490734621588 130,203 C 174.18274339792222,202.15509265378412 219.63960189272785,181.5428242882445 277,163 C 334.36039810727215,144.4571757117555 403.62433582701107,127.98379550080625 451,128 C 498.37566417298893,128.01620449919375 523.863054799228,144.5219937085305 564,153 C 604.136945200772,161.4780062914695 658.9234449760766,161.92822966507174 717,147 C 775.0765550239234,132.07177033492826 836.4431652964657,101.76508763118244 888,123 C 939.5568347035343,144.23491236881756 981.3038938380607,217.01141981019853 1019,211 C 1056.6961061619393,204.98858018980147 1090.3412593512915,120.18923312802349 1135,108 C 1179.6587406487085,95.81076687197651 1235.331068756774,156.23164767770757 1288,178 C 1340.668931243226,199.76835232229243 1390.3344656216132,182.88417616114623 1440,166 C 1440,166 1440,500 1440,500 Z' stroke='none' stroke-width='0' fill='transparent' fill-opacity='0.53' class='transition-all duration-300 ease-in-out delay-150 path-0'></path><style>.path-1{
            animation:pathAnim-1 4s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
          }
          @keyframes pathAnim-1{
            0%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 55.30877104866636,338.281014565545 110.61754209733272,343.5620291310899 164,356 C 217.38245790266728,368.4379708689101 268.83860265933544,388.0328980411853 310,385 C 351.16139734066456,381.9671019588147 382.02804726532554,356.30637870416876 419,353 C 455.97195273467446,349.69362129583124 499.04920827936246,368.7415871421396 560,368 C 620.9507917206375,367.2584128578604 699.7751196172248,346.7272727272727 745,344 C 790.2248803827752,341.2727272727273 801.850313251738,356.3493219487695 840,355 C 878.149686748262,353.6506780512305 942.8236273758228,335.8754394776494 1003,343 C 1063.1763726241772,350.1245605223506 1118.8551772449707,382.1489201406328 1163,393 C 1207.1448227550293,403.8510798593672 1239.7556636442941,393.5288799598192 1284,380 C 1328.2443363557059,366.4711200401808 1384.122168177853,349.73556002009036 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            25%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 33.302955404583784,353.49044383938246 66.60591080916757,373.980887678765 123,363 C 179.39408919083243,352.019112321235 258.87931216791355,309.56689312432263 307,284 C 355.12068783208645,258.43310687567737 371.8768405191785,249.75153982394465 414,280 C 456.1231594808215,310.24846017605535 523.6133257553728,379.426947579899 585,388 C 646.3866742446272,396.573052420101 701.66985645933,344.5406698564593 740,328 C 778.33014354067,311.4593301435407 799.7072484073067,330.41037299426364 839,333 C 878.2927515926933,335.58962700573636 935.5011499114437,321.817838166486 999,323 C 1062.4988500885563,324.182161833514 1132.288151946919,340.31827433979225 1177,354 C 1221.711848053081,367.68172566020775 1241.3462423008802,378.9090644743451 1281,375 C 1320.6537576991198,371.0909355256549 1380.3268788495598,352.04546776282746 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            50%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 50.380210949271714,303.924304105316 100.76042189854343,274.84860821063205 151,298 C 201.23957810145657,321.15139178936795 251.33852335509795,396.5298712627878 293,394 C 334.66147664490205,391.4701287372122 367.88548468106484,311.0319067382167 412,292 C 456.11451531893516,272.9680932617833 511.119537920643,315.3425017843453 570,340 C 628.880462079357,364.6574982156547 691.6363636363635,371.5980861244019 746,378 C 800.3636363636365,384.4019138755981 846.3350075339025,390.26515371804703 881,392 C 915.6649924660975,393.73484628195297 939.0236062280262,391.3412990034101 988,380 C 1036.9763937719738,368.6587009965899 1111.570567553993,348.3696502683127 1171,337 C 1230.429432446007,325.6303497316873 1274.6941235560018,323.1800999233392 1317,324 C 1359.3058764439982,324.8199000766608 1399.6529382219992,328.9099500383304 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            75%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 38.341470829257986,306.8781093869783 76.68294165851597,280.7562187739565 129,288 C 181.31705834148403,295.2437812260435 247.60970419519413,335.85323429115226 295,354 C 342.3902958048059,372.14676570884774 370.8782415607074,367.83084406143433 415,370 C 459.1217584392926,372.16915593856567 518.8773295619762,380.8233894631103 571,374 C 623.1226704380238,367.1766105368897 667.6124401913876,344.8755980861244 718,348 C 768.3875598086124,351.1244019138756 824.6729096724735,379.67421819239206 872,391 C 919.3270903275265,402.32578180760794 957.6959211187184,396.4275291443073 1006,382 C 1054.3040788812816,367.5724708556927 1112.5434058526528,344.6156652303788 1155,346 C 1197.4565941473472,347.3843347696212 1224.1304554706705,373.1098099341775 1269,375 C 1313.8695445293295,376.8901900658225 1376.9347722646648,354.94509503291124 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
            100%{
              d: path('M 0,500 C 0,500 0,333 0,333 C 55.30877104866636,338.281014565545 110.61754209733272,343.5620291310899 164,356 C 217.38245790266728,368.4379708689101 268.83860265933544,388.0328980411853 310,385 C 351.16139734066456,381.9671019588147 382.02804726532554,356.30637870416876 419,353 C 455.97195273467446,349.69362129583124 499.04920827936246,368.7415871421396 560,368 C 620.9507917206375,367.2584128578604 699.7751196172248,346.7272727272727 745,344 C 790.2248803827752,341.2727272727273 801.850313251738,356.3493219487695 840,355 C 878.149686748262,353.6506780512305 942.8236273758228,335.8754394776494 1003,343 C 1063.1763726241772,350.1245605223506 1118.8551772449707,382.1489201406328 1163,393 C 1207.1448227550293,403.8510798593672 1239.7556636442941,393.5288799598192 1284,380 C 1328.2443363557059,366.4711200401808 1384.122168177853,349.73556002009036 1440,333 C 1440,333 1440,500 1440,500 Z');
            }
          }</style><defs><linearGradient id='gradient' x1='0%' y1='50%' x2='100%' y2='50%'><stop offset='5%' stop-color='#7bdcb5'></stop><stop offset='95%' stop-color='#abb8c3'></stop></linearGradient></defs><path d='M 0,500 C 0,500 0,333 0,333 C 55.30877104866636,338.281014565545 110.61754209733272,343.5620291310899 164,356 C 217.38245790266728,368.4379708689101 268.83860265933544,388.0328980411853 310,385 C 351.16139734066456,381.9671019588147 382.02804726532554,356.30637870416876 419,353 C 455.97195273467446,349.69362129583124 499.04920827936246,368.7415871421396 560,368 C 620.9507917206375,367.2584128578604 699.7751196172248,346.7272727272727 745,344 C 790.2248803827752,341.2727272727273 801.850313251738,356.3493219487695 840,355 C 878.149686748262,353.6506780512305 942.8236273758228,335.8754394776494 1003,343 C 1063.1763726241772,350.1245605223506 1118.8551772449707,382.1489201406328 1163,393 C 1207.1448227550293,403.8510798593672 1239.7556636442941,393.5288799598192 1284,380 C 1328.2443363557059,366.4711200401808 1384.122168177853,349.73556002009036 1440,333 C 1440,333 1440,500 1440,500 Z' stroke='none' stroke-width='0' fill='black' fill-opacity='1' class='transition-all duration-300 ease-in-out delay-150 path-1'></path></svg>
                            </div>

                            <div class="contents">

                                <h1>COMING SOON...</h1>

                            </div>


                        </div>
                        
                    </div>

                </div>

            </div>
            
        </div>
    </div>

</body>
</html>