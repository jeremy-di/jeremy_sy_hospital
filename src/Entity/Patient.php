<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $zipCode = null;

    #[ORM\Column(length: 255)]
    private ?string $town = null;

    #[ORM\Column(length: 255)]
    private ?string $inseeNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $medicalMutual = null;

    #[ORM\Column(length: 255)]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $pathology = null;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Room::class)]
    private Collection $rooms;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'patients')]
    private Collection $staffMember;

    #[ORM\ManyToMany(targetEntity: Treatment::class, mappedBy: 'patients')]
    private Collection $treatment;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->staffMember = new ArrayCollection();
        $this->treatment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }

    public function setZipCode(int $zipCode): static
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getInseeNumber(): ?int
    {
        return $this->inseeNumber;
    }

    public function setInseeNumber(int $inseeNumber): static
    {
        $this->inseeNumber = $inseeNumber;

        return $this;
    }

    public function getMedicalMutual(): ?string
    {
        return $this->medicalMutual;
    }

    public function setMedicalMutual(string $medicalMutual): static
    {
        $this->medicalMutual = $medicalMutual;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getPathology(): ?string
    {
        return $this->pathology;
    }

    public function setPathology(string $pathology): static
    {
        $this->pathology = $pathology;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): static
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setPatient($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): static
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getPatient() === $this) {
                $room->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getStaffMember(): Collection
    {
        return $this->staffMember;
    }

    public function addStaffMember(User $staffMember): static
    {
        if (!$this->staffMember->contains($staffMember)) {
            $this->staffMember->add($staffMember);
        }

        return $this;
    }

    public function removeStaffMember(User $staffMember): static
    {
        $this->staffMember->removeElement($staffMember);

        return $this;
    }

    /**
     * @return Collection<int, Treatment>
     */
    public function getTreatment(): Collection
    {
        return $this->treatment;
    }

    public function addTreatment(Treatment $treatment): static
    {
        if (!$this->treatment->contains($treatment)) {
            $this->treatment->add($treatment);
            $treatment->addPatient($this);
        }

        return $this;
    }

    public function removeTreatment(Treatment $treatment): static
    {
        $this->treatment->removeElement($treatment);

        return $this;
    }
}
