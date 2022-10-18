<?php

namespace App\Entity;

use App\Repository\LocalizationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocalizationRepository::class)]
class Localization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $country_code = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longtitude = null;

    #[ORM\OneToMany(mappedBy: 'localization', targetEntity: Measurment::class)]
    private Collection $measurments;

    public function __construct()
    {
        $this->measurments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->country_code;
    }

    public function setCountryCode(string $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongtitude(): ?float
    {
        return $this->longtitude;
    }

    public function setLongtitude(float $longtitude): self
    {
        $this->longtitude = $longtitude;

        return $this;
    }

    /**
     * @return Collection<int, Measurment>
     */
    public function getMeasurments(): Collection
    {
        return $this->measurments;
    }

    public function addMeasurment(Measurment $measurment): self
    {
        if (!$this->measurments->contains($measurment)) {
            $this->measurments->add($measurment);
            $measurment->setLocalization($this);
        }

        return $this;
    }

    public function removeMeasurment(Measurment $measurment): self
    {
        if ($this->measurments->removeElement($measurment)) {
            // set the owning side to null (unless already changed)
            if ($measurment->getLocalization() === $this) {
                $measurment->setLocalization(null);
            }
        }

        return $this;
    }
}
