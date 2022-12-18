<?php
include "conf.php";
include "modules/search.php";
include "pages/contact.php";
include "pages/credits.php";
include "pages/home.php";
include "pages/official_agenda.php";
include "pages/official_history.php";
include "pages/official_gallery.php";
include "pages/official_news.php";
include "pages/official_profile.php";
include "pages/officials.php";
include "pages/projects_finished.php";
include "pages/projects_ongoing.php";
include "pages/reviews_anime.php";
include "pages/reviews_dorama.php";
include "pages/reviews_jmusic.php";
include "pages/reviews_manga.php";
include "pages/reviews_tokusatsu.php";

function get_switch(){
	
	$act = empty($_GET['m']) ? ' ':$_GET['m'];
			
		switch($act){
			// Official Part
			case "official_profile":
				OfficialProfile();
				break;
			case "official_history":
				OfficialHistory();
				break;
			case "officials":
				officials();
				break;
			case "official_agenda":
				OfficialAgenda();
				break;
			case "official_news":
				OfficialNews();
				break;
			case "detailed_news":
				DetailedNews();
				break;	
			case "official_gallery":
				OfficialGallery();
				break;
			case "detailed_gallery":
				DetailedGallery();
				break;	
			// Misc Part	
			case "contact":
				contact();
				break;
			case "credits":
				credits();
				break;	
			// Anime Reviews	
			case "reviews_a_nime":
				AnimeReviews();
				break;
			case "search_reviews_a_nime":
				SearchAnimeReviews();
				break;
			case "result_detailed_reviews_a_nime":
				ResultDetailedAnimeReviews();
				break;
			// Manga Reviews
			case "reviews_m_anga":
				MangaReviews();
				break;
			case "search_reviews_m_anga":
				SearchMangaReviews();
				break;
			case "result_detailed_reviews_m_anga":
				ResultDetailedMangaReviews();
				break;
			// Tokusatsu Reviews	
			case "reviews_t_okusatsu":
				TokusatsuReviews();
				break;
			case "search_reviews_t_okusatsu":
				SearchTokusatsuReviews();
				break;
			case "result_detailed_reviews_t_okusatsu":
				ResultDetailedTokusatsuReviews();
				break;
			// Dorama Reviews	
			case "reviews_d_orama":
				DoramaReviews();
				break;
			case "search_reviews_d_orama":
				SearchDoramaReviews();
				break;
			case "result_detailed_reviews_d_orama":
				ResultDetailedDoramaReviews();
				break;
			// Projects Reviews	
			case "projects":
				projects();
				break;
			case "f_projects":
				f_projects();
				break;
			// J-Music Reviews
			case "reviews_j_music":
				JMusicReviews();
				break;
			case "search_reviews_j_music":
				SearchJMusicReviews();
				break;
			case "result_detailed_reviews_j_music":
				ResultDetailedJMusicReviews();
				break;
			// Search (Optional)	
			case "Search":
				Search();
				break;
			case "Result":
				Result();
				break;
			case "ResultDetail":
				ResultDetailed();
				break;											
			default:
				home();
			}	
}

get_switch();

?>