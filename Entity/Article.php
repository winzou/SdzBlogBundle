<?php

namespace Sdz\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Sdz\BlogBundle\Entity\Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sdz\BlogBundle\Entity\ArticleRepository")
 */
class Article
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text $contenu
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
    
   /**
    * @var string $pseudo
    *
    * @ORM\Column(name="pseudo", type="string", length=255)
    */
    private $pseudo;

    /**
     * @ORM\ManyToMany(targetEntity="Sdz\BlogBundle\Entity\Tag")
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->date = new \Datetime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param text $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * Get contenu
     *
     * @return text 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    
    /**
     * Add tag
     *
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Get tags
     *
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }
}