<?php

namespace Loic\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="Loic\CMSBundle\Repository\AdvertRepository")
 * @Gedmo\Loggable
 */
class Advert
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Gedmo\Versioned
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Loic\CMSBundle\Entity\Category")
     */
    private $firstCategory;

    /**
     * @ORM\ManyToMany(targetEntity="Loic\CMSBundle\Entity\Category")
     */
    private $categories;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="access", type="string")
     */
    private $access;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set firstCategory
     *
     * @param \Loic\CMSBundle\Entity\Category $firstCategory
     *
     * @return Advert
     */
    public function setFirstCategory(\Loic\CMSBundle\Entity\Category $firstCategory = null)
    {
        $this->firstCategory = $firstCategory;

        return $this;
    }

    /**
     * Get firstCategory
     *
     * @return \Loic\CMSBundle\Entity\Category
     */
    public function getFirstCategory()
    {
        return $this->firstCategory;
    }

    /**
     * Add category
     *
     * @param \Loic\CMSBundle\Entity\Category $category
     *
     * @return Advert
     */
    public function addCategory(\Loic\CMSBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Loic\CMSBundle\Entity\Category $category
     */
    public function removeCategory(\Loic\CMSBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Advert
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set access
     *
     * @param string $access
     *
     * @return Advert
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }
}
