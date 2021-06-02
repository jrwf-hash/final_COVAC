<?php
	require("covacDB.php");
?>

<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1, minimum-scale=1" />

  <title>COVAC</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
</head>

<body>
  <div id="body_container">

    <header id="header" class="display_flex_center">
      <a href="http://www.covac.news/">
        <img src="./src/assets/logo.png" alt="covac_logo" />
      </a>
    </header>

    <main id="main" class="display_flex_center">
      <div class="main_content_wrapper">

        <nav id="nav">
          <ul class="nav_ul">
            <li><a href="http://www.covac.news/" class="none_low_depth">백신</a></li>
            <li>
              <div class="has_low_depth">기사</div>
              <ul class="low_depth">
                <li><a href="arti_press.php">언론사별</a></li>
                <li><a href="arti_vac.php">백신별</a></li>
              </ul>
            </li>
            <li><a href="board.php" class="none_low_depth selected">접종후기</a></li>
            <li>
              <div class="has_low_depth">공지</div>
              <ul class="low_depth">
                <li><a href="announce_1.php">공지사항</a></li>
                <li><a href="announce_2.php">문의 및 제보</a></li>
                <li><a href="announce_3.php">후원정보</a></li>
              </ul>
            </li>
            <li>
              <div class="has_low_depth">바로알기</div>
              <ul class="low_depth">
                <li><a href="check_vac.php">백신 종류별 특성</a></li>
                <li><a href="check_place.php">백신 접종 기관</a></li>
                <li><a href="check_vid.php">백신 동영상</a></li>
              </ul>
            </li>
          </ul>
        </nav>

        <article>
          <?php
			$num = $_REQUEST["num"];
			$query = $db->query("select * from Epilogue where num = '$num'");
			$row = $query->fetch();
		?>
          <section id="section_container" class="section_write_review">
            <div class="board_header">
              <h1>코로나 접종 후기 게시판</h1>
              <p>
                코로나 백신 접종하신 분들의 후기를 작성하는 게시판입니다.<br />
                여러분들의 정보가 대한민국의 백신입니다.
              </p>
              <h3>허위 사실을 유포하시면 법적 처벌을 받을 수 있습니다.</h3>
            </div>
            <div class="write_review_container">
				<table class="tbl_write">
					<caption>글쓰기 폼</caption>
					<colgroup>
						<col width="20%" />
						<col width="*" />
					</colgroup>
					<tbody>
						<tr>
							<td colspan="2">
								<p class="tit">글 제목입니다.</p>
							</td>
						</tr>
						<tr>
							<td><p class="writer">작성자</p></td>
							<td><p class="file_name"><span>파일</span> 123.jpg</p></td>
						</tr>
						<tr>
							<td colspan="2">
								<textarea name="" id="" cols="30" rows="10">코로나 접종 후기 게시판 내용입니다.</textarea>
							</td>
						</tr>
					</tbody>
				</table>
              <!-- <div class="review_item">
                <p style="font-size: 24px; font-weight:400;">글제목입니다.</p>
              </div>
              <div class="my_post">

                <p style="color: #606060;
                background-color: #cccccc;
                padding: 5px;
                margin-right: 520px;
                text-align: left;
                border-radius: 15px;

                font-size: 15px;">작성자 </p>
                <div style="position:absolute; margin-left:100px; margin-top:-25px;">
                  <span>파일 첨부</span>
                  <input class="input_upload_file" type="file" />

                </div>

              </div>
              <div class="review_item">
                <textarea rows="30" placeholder="내용입니다." readonly></textarea>
              </div> -->
            </div>
            <div class="footer_wrapper">
              <button type="button" class="btn_register"><a href="board.php">뒤로</a></button>
            </div>
          </section>
          <div id="footer_section_container">
            <section>
              <div class="ad_wrapper_mainpage">
                <img src="./src/assets/ad.png" width="650"alt="ad" />
              </div>
            </section>
          </div>
        </article>

      </div>
    </main>

    <footer id="footer">
      Copyright 2021. 1조 All pictures cannot be copied without permission.
      <br />
      yghasd@g.shingu.ac.kr
    </footer>

  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      const handleCommonNavFunction = () => {
        //첫 페이지 로딩시, 보이는 메뉴 모두 최소화
        $("#nav ul li div").removeClass("selected")
        $("#nav ul li a").removeClass("selected")
        $("#nav ul.low_depth").hide()
      }
      //백신, 접종후기 선택시 selected로 변경
      $("#nav ul li a.none_low_depth").click(function() {
        handleCommonNavFunction()
        $(this).addClass("selected")
      })
      //기사, 공지, 바로알기 선택시 selected로 변경, 누르면 아래 메뉴 펼쳐짐
      $("#nav ul li .has_low_depth").click(function() {
        handleCommonNavFunction()
        $(this).addClass("selected")
        $(this).next().slideToggle("slow")
      })
      //기사, 공지, 바로알기 하단 메뉴 선택시, 선택한 상위메뉴를 선택해제하고
      //하단 메뉴 선택으로 변경
      $("#nav ul.low_depth li a").click(function() {
        $("#nav ul.low_depth li a").removeClass("selected")
        $(this).addClass("selected")
        $(this).next().slideToggle("slow")
      })
    })
  </script>
</body>

</html>
