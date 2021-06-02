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

		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.css"
		/>
		<link rel="stylesheet" type="text/css" href="./style.css" />
		<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.12.1/css/all.css"
			crossorigin="anonymous"
		/>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
		<script type="text/javascript" src="init.js"></script>
	</head>
	<body>
		<div id="body_container">
			<header id="header" class="display_flex_center">
				<a href="http://www.covac.news/">
					<img src="./src/assets/logo.png" alt="covac_logo" />
				</a>
			</header>
			<div id="main" class="display_flex_center">
				<div class="main_content_wrapper">
					<nav id="nav">
						<ul class="nav_ul">
							<li><a href="http://www.covac.news/" class="none_low_depth">백신</a></li>
							<li>
								<div class="has_low_depth selected">기사</div>
								<ul class="low_depth show1">
									<li>
										<a href="arti_press.php" class="selected">언론사별</a>
									</li>
									<li><a href="arti_vac.php">백신별</a></li>
								</ul>
							</li>
							<li><a href="board.php" class="none_low_depth">접종후기</a></li>
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
					<!--메인 구성-->
					<article>
						<section id="section_container" class="section_arti_vac">
							<div class="news_vac">
								<!--뉴스 필터 부분-->
								<div class="news_filter_container">
									<form action="" class="check_news">
										<label
											><input type="checkbox" name="check" value="JTBC" onclick="oneCheckbox(this)"/>
											JTBC</label
										>
										<label
											><input type="checkbox" name="check" value="MBC" onclick="oneCheckbox(this)"/>
											MBC</label
										>
										<label
											><input type="checkbox" name="check" value="YTN" onclick="oneCheckbox(this)"/>
											YTN</label
										>
										<label
											><input type="checkbox" name="check" value="동아일보" onclick="oneCheckbox(this)"/>
											동아일보</label
										>
										<label
											><input type="checkbox" name="check" value="조선일보" onclick="oneCheckbox(this)"/>
											조선일보</label
										>
										<label
											><input
												type="checkbox"
												name="check"
												value="selectall"
												onclick="oneCheckbox(this)"
												checked="checked"
											/>
											모든기사</label
										>
									</form>

									<form action="http://www.covac.news/arti_press_result.php" method="get">
									<div class="search_wrapper display_flex_center">
										<input
											placeholder="검색하기"
											type="search"
											class="search"
											required="required"
											name="search"
										/>
										<span><img src="./src/assets/glasses.png" alt="" /></span>
									</div>
									</form>
								</div>
								<!--기사 구성 부분-->
								<div class="news_container">
									<?php
					$listSize = 9;
					$page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];

					try {

					$paginationS = 5;

					$first = floor(($page - 1) / $paginationS) * $paginationS + 1;
					$last = $first + $paginationS - 1;

					$numRecords = $db->query("select count(*) from News_Cl where title like '%{$search}%'")->fetchColumn();
					$numPages = ceil($numRecords / $listSize);
					if ($last > $numPages) {
						$last = $numPages;
					}

					$start = ($page - 1) * $listSize;
					$query = $db->query("select * from News_Cl where title like '%{$search}%' order by num desc limit $start,$listSize");
					while ($row = $query->fetch()) {
				?>
				<div class="responsive">
					<div class="gallery">
						<a target="_self" href="<?=$row["url"]?>">
							<img
								src="<?=$row["img"]?>"
								alt="<?=$row["alt"]?>"
								width="600"
								height="400"
							/>
						</a>
						<div class="desc">
							<?=$row["title"]?>
						</div>
					</div>
				</div>
			<?php
				}
			} catch (PDOException $e) {
				exit($e->getMessage());
			}
		?>

									<div class="clearfix">
										<button type="button" name="button"></button>
									</div>
								</div>
								<!--하단 페이지 넘기는 부분-->
								<div class="pages_turner">
         					<a class="bold_arrow" href="http://www.covac.news/arti_press_result.php?search=<?=$search?>"><&nbsp;<</a>
        					<?php
										if ($first > 1) {
									?>
									<a href="http://www.covac.news/arti_press_result.php?page=<?=($first - 1)?>&search=<?=$search?>">&lt;</a>
									<?php
										}
										for($i = $first; $i <= $last; $i++) {
									?>
									<a href="http://www.covac.news/arti_press_result.php?page=<?=$i?>&search=<?=$search?>"><?=$i?></a>
									<?php
										}
										if ($last < $numPages) {
									?>
									<a href="http://www.covac.news/arti_press_result.php?page=<?=($last + 1)?>&search=<?=$search?>">&gt;</a>
									<?php
										}
									?>
        					<a class="bold_arrow" href="http://www.covac.news/arti_press_result.php?page=<?=$numPages?>&search=<?=$search?>">>&nbsp;></a>
      					</div>
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
		<!--메뉴바 js-->
		<!-- <script type="text/javascript">
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
		</script> -->
		<!--기사 선택 js-->
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript">
			function selectAll(selectAll) {
				const checkboxes = document.getElementsByName("check")

				checkboxes.forEach((checkbox) => {
					checkbox.checked = selectAll.checked
				})
			}
			function oneCheckbox(a){
				var obj = document.getElementsByName("check");
				for(var i=0; i<obj.length; i++){
						if(obj[i] != a){
								obj[i].checked = false;
						}
				}
			}
		</script>

	</body>
</html>
