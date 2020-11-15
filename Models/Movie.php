<?php
namespace Models;

class Movie
{
    private $popularity;
    private $vote_count;
    private $video;
    private $poster_path;
    private $id;
    private $adult;
    private $backdrop_path;
    private $original_language;
    private $original_title;
    private $title;
    private $vote_average;
    private $overview;
    private $genres;
    private $duration;
    
    public function __construct ($id, $title, $popularity, $vote_count, $video, $poster_path, $adult, $backdrop_path, $original_language, $original_title, 
      $vote_average, $overview, $duration)
    {
        $this->setId($id);
        $this->setPopularity($popularity);
        $this->setvote_count($vote_count);
        $this->setVideo($video);
        $this->setposter_path($poster_path);
        $this->setAdult($adult);
        $this->setbackdrop_path($backdrop_path);
        $this->setoriginal_language($original_language);
        $this->setoriginal_title($original_title);
        $this->setTitle($title);
        $this->setvote_average($vote_average);
        $this->setOverview($overview);
        $this->setDuration($duration);
        $this->genres = array();
    }
        
    public function setPopularity ($popularity) {$this->popularity = $popularity;}
    public function setvote_count ($vote_count) {$this->vote_count = $vote_count;}
    public function setVideo($video) {$this->video = $video;}
    public function setposter_path ($poster_path) {$this->poster_path = $poster_path;}
    public function setId ($id) {$this->id = $id;} 
    public function setAdult ($adult) {$this->adult= $adult;}
    public function setbackdrop_path ($backdrop_path) {$this->backdrop_path = $backdrop_path;}
    public function setoriginal_language ($original_language) {$this->original_language = $original_language;}
    public function setoriginal_title ($original_title) {$this->original_title = $original_title;}
    public function setTitle ($title) {$this->title = $title;}
    public function setvote_average ($vote_average) {$this->vote_average=$vote_average;} 
    public function setOverview($overview) {$this->overview= $overview;}
    public function setDuration($duration) {$this->duration = $duration;}
    public function setGenres($genres) {$this->genres = $genres;}
    
    public function getPopularity () {return $this->popularity;}
    public function getvote_count () {return $this->vote_count;}
    public function getVideo () {return $this->video;}
    public function getposter_path () {return $this->poster_path;}
    public function getId () {return $this->id;}
    public function getAdult () {return $this->adult;}
    public function getbackdrop_path () {return $this->backdrop_path;}
    public function getoriginal_language () {return $this->original_language;}
    public function getoriginal_title () {return $this->original_title;}
    public function getTitle () {return $this->title;}
    public function getvote_average () {return $this->vote_average;}
    public function getOverview () {return $this->overview;}
    public function getDuration () {return $this->duration;}
    public function getGenres () {return $this->genres;}
 }

?>