<?php
namespace Models;

class Movie
{
    private $popularity;
    private $voteCount;
    private $video;
    private $posterPath;
    private $id;
    private $adult;
    private $backdropPath;
    private $originalLenguage;
    private $originalTitle;
    #private Arrayvalue $genreIds;
    private $title;
    private $voteAverage;
    private $overview;
    private $releaseDate;
    private $enabled;
   
    
    
    public function __construct ($popularity, $voteCount, $video, $posterPath, $id, $adult, $backdropPath, $originalLenguage, $originalTitle, $genreIds,
     $title, $voteAverage, $overview, $releaseDate, $enabled)
    {
        $this->setPopularity($popularity);
        $this->setVoteCount($voteCount);
        $this->setVideo($video);
        $this->setPosterPath($posterPath);
        $this->setId($id);
        $this->setAdult($adult);
        $this->setBackdropPath($backdropPath);
        $this->setOriginalLenguage($originalLenguage);
        $this->setOriginalTitle($originalTitle);
        #$this->setGenreIds($genreIds);
        $this->setTitle($title);
        $this->setVoteAverage($voteAverage);
        $this->setOverview($overview);
        $this->setReleaseDate($releaseDate);
        $this->setEnabled($enabled);
    }
    
    public function setPopularity ($popularity) {$this->popularity = $popularity;}
    public function setVoteCount ($voteCount) {$this->voteCount = $voteCount;}
    public function setVideo($video) {$this->video = $video;}
    public function setPosterPath ($posterPath) {$this->posterPath = $posterPath;}
    public function setId ($id) {$this->id = $id;} 
    public function setAdult ($adult) {$this->adult= $adult;}
    public function setBackdropPath ($backdropPath) {$this->backdropPath = $backdropPath;}
    public function setOriginalLenguage ($originalLenguage) {$this->originalLenguage = $originalLenguage;}
    public function setOriginalTitle ($originalTitle) {$this->originalTitle = $originalTitle;}
    #public function setGenreIds($genreIds) {$this->genreIds = $genreIds;}
    public function setTitle ($title) {$this->title = $title;}
    public function setVoteAverage ($voteAverage) {$this->voteAverage=$voteAverage;} 
    public function setOverview($overview) {$this->overview= $overview;}
    public function setReleaseDate ($releaseDate) {$this->releaseDateId = $releaseDate;}
    public function setEnabled ($enabled) {$this->enabled = $enabled;}

    public function getPopularity () {return $this->popularity;}
    public function getVoteCount () {return $this->voteCount;}
    public function getVideo () {return $this->video;}
    public function getPosterPath () {return $this->posterPath;}
    public function getId () {return $this->id;
    public function getAdult () {return $this->adult;}
    public function getBackdropPath () {return $this->backdropPath;}
    public function getOriginalLenguage () {return $this->originalLenguage;}
    public function getOriginalTitle () {return $this->originalTitle;}
    #public function getGenreIds () {return $this->genreIds;}
    public function getTitle () {return $this->title;}
    public function getVoteAverage () {return $this->voteAverage;}
    public function getOverview () {return $this->overview;}
    public function getReleaseDate () {return $this->ReleaseDate;}
    public function getEnabled () {return $this->enabled;}
}

?>