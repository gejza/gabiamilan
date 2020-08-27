<?php

namespace App\Entity;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $file;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $originalTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getOriginalTime(): ?\DateTimeInterface
    {
        return $this->originalTime;
    }

    public function setOriginalTime(?\DateTimeInterface $originalTime): self
    {
        $this->originalTime = $originalTime;

        return $this;
    }
    
    public function getOrigFile()
    {
	    return \realpath(__DIR__.'/../../public/uploads/'.$this->getFile());
    }
    
    public function getThumbFile()
    {
	    return \realpath(__DIR__.'/../../').'/public/uploads/thumb/'.$this->getFile();
    }
	
	public function getThumbUrl()
	{
		$package = new Package(new StaticVersionStrategy('v2'));
		return $package->getUrl('/uploads/thumb/'.$this->getFile());
		//return \dirname(__DIR__).'/public/uploads/'.$this->getFile();
	}
	
	public function getImageUrl()
	{
		$package = new Package(new StaticVersionStrategy('v2'));
		return $package->getUrl('/uploads/'.$this->getFile());
		//return \dirname(__DIR__).'/public/uploads/'.$this->getFile();
	}
}
