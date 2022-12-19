<?php
include "conf.php";
include "admin/admin_chpass.php";
include "admin/admin_contact.php";
include "admin/admin_gallery.php";
include "admin/admin_home.php";
include "admin/admin_official_agenda.php";
include "admin/admin_official_history.php";
include "admin/admin_official_news.php";
include "admin/admin_official_profile.php";
include "admin/admin_officials.php";
include "admin/admin_projects_finished.php";
include "admin/admin_projects_ongoing.php";
include "admin/admin_reviews_anime.php";
include "admin/admin_reviews_dorama.php";
include "admin/admin_reviews_jmusic.php";
include "admin/admin_reviews_manga.php";
include "admin/admin_reviews_tokusatsu.php";
include "pages/credits.php";

function get_switch(){

	$act = empty($_GET['m']) ? ' ':$_GET['m'];

		switch($act){
			// Maintenance
			case "CheckTables";
				CheckTables();
				break;
			case "OptimizeTables";
				OptimizeTables();
				break;
			case "RepairTables";
				RepairTables();
				break;
			case "ChangePassword";
				ChangePassword();
				break;
			case "ConfirmPassword";
				ConfirmPassword();
				break;
			// Official Profile
			case "BrowseOfficialProfile";
				BrowseOfficialProfile();
				break;
			case "EditOfficialProfile":
				EditOfficialProfile();
				break;
			// Official History
			case "BrowseOfficialHistory";
				BrowseOfficialHistory();
				break;
			case "EditOfficialHistory":
				EditOfficialHistory();
				break;
			// Officials
			case "AddOfficials":
				AddOfficials();
				break;
			case "ListOfficials";
				ListOfficials();
				break;
			case "BrowseOfficials";
				BrowseOfficials();
				break;
			case "DeleteOfficials";
				DeleteOfficials();
				break;
			case "EditOfficials";
				EditOfficials();
				break;
			// Official News
			case "AddOfficialNews":
				AddOfficialNews();
				break;
			case "ListOfficialNews";
				ListOfficialNews();
				break;
			case "BrowseOfficialNews";
				BrowseOfficialNews();
				break;
			case "DeleteOfficialNews";
				DeleteOfficialNews();
				break;
			case "EditOfficialNews";
				EditOfficialNews();
				break;
			// Official Agenda
			case "AddOfficialAgenda":
				AddOfficialAgenda();
				break;
			case "ListOfficialAgenda";
				ListOfficialAgenda();
				break;
			case "BrowseOfficialAgenda";
				BrowseOfficialAgenda();
				break;
			case "DeleteOfficialAgenda";
				DeleteOfficialAgenda();
				break;
			case "EditOfficialAgenda";
				EditOfficialAgenda();
				break;
			// Official Gallery
			case "AddGallery":
				AddGallery();
				break;
			case "ListGallery";
				ListGallery();
				break;
			case "BrowseGallery";
				BrowseGallery();
				break;
			case "DeleteGallery";
				DeleteGallery();
				break;
			case "EditGallery";
				EditGallery();
				break;
			// Contact Us
			case "contact":
				contact();
				break;
			// Anime Reviews
			case "TambahA_nimeReviews":
				TambahAnimeReviews();
				break;
			case "TampilA_nimeReviews";
				TampilAnimeReviews();
				break;
			case "BrowseA_nimeReviews";
				BrowseAnimeReviews();
				break;
			case "DeleteA_nimeReviews";
				DeleteAnimeReviews();
				break;
			case "EditA_nimeReviews";
				EditAnimeReviews();
				break;
			//Manga Reviews
			case "TambahM_angaReviews":
				TambahMangaReviews();
				break;
			case "TampilM_angaReviews";
				TampilMangaReviews();
				break;
			case "BrowseM_angaReviews";
				BrowseMangaReviews();
				break;
			case "DeleteM_angaReviews";
				DeleteMangaReviews();
				break;
			case "EditM_angaReviews";
				EditMangaReviews();
				break;
			// Tokusatsu Reviews
			case "TambahT_okusatsuReviews":
				TambahTokusatsuReviews();
				break;
			case "TampilT_okusatsuReviews";
				TampilTokusatsuReviews();
				break;
			case "BrowseT_okusatsuReviews";
				BrowseTokusatsuReviews();
				break;
			case "DeleteT_okusatsuReviews";
				DeleteTokusatsuReviews();
				break;
			case "EditT_okusatsuReviews";
				EditTokusatsuReviews();
				break;
			// Dorama Reviews
			case "TambahD_oramaReviews":
				TambahDoramaReviews();
				break;
			case "TampilD_oramaReviews";
				TampilDoramaReviews();
				break;
			case "BrowseD_oramaReviews";
				BrowseDoramaReviews();
				break;
			case "DeleteD_oramaReviews";
				DeleteDoramaReviews();
				break;
			case "EditD_oramaReviews";
				EditDoramaReviews();
				break;
			// Ongoing Projects
			case "TambahOngoingProjects":
				TambahOngoingProjects();
				break;
			case "TampilOngoingProjects";
				TampilOngoingProjects();
				break;
			case "BrowseOngoingProjects";
				BrowseOngoingProjects();
				break;
			case "DeleteOngoingProjects";
				DeleteOngoingProjects();
				break;
			case "EditOngoingProjects";
				EditOngoingProjects();
				break;
			// Finished Projects
			case "TambahFinishedProjects":
				TambahFinishedProjects();
				break;
			case "TampilFinishedProjects";
				TampilFinishedProjects();
				break;
			case "BrowseFinishedProjects";
				BrowseFinishedProjects();
				break;
			case "DeleteFinishedProjects";
				DeleteFinishedProjects();
				break;
			case "EditFinishedProjects";
				EditFinishedProjects();
				break;
			// J-Music
			case "TambahJ_MusicReviews":
				TambahJMusicReviews();
				break;
			case "TampilJ_MusicReviews";
				TampilJMusicReviews();
				break;
			case "BrowseJ_MusicReviews";
				BrowseJMusicReviews();
				break;
			case "DeleteJ_MusicReviews";
				DeleteJMusicReviews();
				break;
			case "EditJ_MusicReviews";
				EditJMusicReviews();
				break;
			// Credits
			case "credits":
				credits();
				break;
			default:
				home();
			}
}

get_switch();

?>