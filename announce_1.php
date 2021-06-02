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
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1, minimum-scale=1"
		/>

		<title>COVAC</title>
		<link rel="icon" href="./img/favicon.jpg">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css"/>
		<link rel="stylesheet" type="text/css" href="./style.css" />
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
		<script type="text/javascript" src="init.js"></script>
	</head>
	<body>
		<div id="body_container">
			<header id="header" class="display_flex_center">
				<a href="http://www.covac.news">
					<img src="./src/assets/logo.png" alt="covac_logo" />
				</a>
			</header>
			<div id="main" class="display_flex_center">
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
							<li><a href="board.php" class="none_low_depth">접종후기</a></li>
							<li>
								<div class="has_low_depth selected">공지</div>
								<ul class="low_depth show2">
									<li><a href="announce_1.php" class="selected">공지사항</a></li>
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



						<section id="section_container" class="section_review_posts">

							<div class="board_header_ann">
								<h1>공지사항</h1>
							</div>

							<div class="posts_container">
								<!-- 공지
								<tr class="post_notice">
									<td>
										<span class="label_notice">공지</span>
									</td>
									<td>[이벤트] 후기 랜덤 추첨</td>
									<td>COVAC</td>
									<td>2021.03.23</td>
									<td>23</td>
								</tr>
								-->
								<table>
									<colgroup>
										<col style="width: 100px !important" />
										<col />
										<col style="width: 100px" />
										<col style="width: 130px" />
										<col style="width: 100px" />
									</colgroup>
									<thead>
										<tr>
											<th scope="col">게시물 번호</th>
											<th scope="col">제목</th>
											<th scope="col">작성자</th>
											<th scope="col">등록일</th>
											<th scope="col">조회수</th>
										</tr>
									</thead>
									<?php
											$query = $db->query("select * from Notice order by num desc limit 0,10");
											while ($row = $query->fetch()) {
												$title=$row["title"];
											if(strlen($title)>30)
											{
												//title이 12을 넘어서면 ...표시
												$title=str_replace($row["title"],mb_substr($row["title"],0,30,"utf-8")."...",$row["title"]);
											}
										?>
									<tbody>
										<tr>
											<td><?=$row["num"]?></td>
											<td><a href=""><?php echo $title;?></a></td>
											<td><?=$row["name"]?></td>
											<td><?=$row["day"]?></td>
											<td><?=$row["view"]?></td>
										</tr>
									</tbody>
									<?php
											}
										?>
								</table>
							</div>
							<div class="footer_wrapper">
								<div class="search_wrapper display_flex_center">
									<input placeholder="검색하기" type="search" class="search" />
									<span><img src="./src/assets/glasses.png"  /></span>
								</div>

							</div>
							<div class="pages_wrapper">
								<a class="bold_arrow" href="#"><<</a>
								<a href="#"><</a>
								<span>
									<a href="#">1</a>
									<a href="#">2</a>
									<a href="#">3</a>
									<a href="#">4</a>
									<a href="#">5</a>
									<a href="#">6</a>
								</span>
								<a href="#">></a>
								<a class="bold_arrow" href="#">>></a>
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
			</div>
			<footer id="footer">
				Copyright 2021. 1조 All pictures cannot be copied without permission.
				<br />
				yghasd@g.shingu.ac.kr
			</footer>
		</div>
<!-- 		<script type="text/javascript">
		if(matchMedia("screen and (max-width: 1200px)").matches){

			$(document).ready(function () {
				const handleCommonNavFunction = () => {
					$("#nav ul li div").removeClass("selected")
					$("#nav ul li a").removeClass("selected")
					$("#nav ul.low_depth").hide()
				}

				$("#nav ul li a.none_low_depth").click(function () {
					handleCommonNavFunction()
					$(this).addClass("selected")
				})
				$("#nav ul li .has_low_depth").click(function () {
					handleCommonNavFunction()
					$(this).addClass("selected")
					$(this).next().slideToggle("slow")
				})
				$("#nav ul.low_depth li a").click(function () {
					$("#nav ul.low_depth li a").removeClass("selected")
					$(this).addClass("selected")
					$(this).next().slideToggle("slow")

				})
			})
		}else{
			$(document).ready(function () {
				const handleCommonNavFunction = () => {
					$("#nav ul li div").removeClass("selected")
					$("#nav ul li a").removeClass("selected")
					$("#nav ul.low_depth").hide()
				}

				$("#nav ul li a.none_low_depth").click(function () {
					handleCommonNavFunction()
					$(this).addClass("selected")

				})
				$("#nav ul li .has_low_depth").click(function () {
					handleCommonNavFunction()
					$(this).addClass("selected")
					$(this).next().slideToggle("slow")

				})
				$("#nav ul.low_depth li a").click(function () {
					$("#nav ul.low_depth li a").removeClass("selected")
					$(this).addClass("selected")
					$(this).next().slideToggle("slow")

				})
			})
		}
		</script> -->
	</body>
</html>
