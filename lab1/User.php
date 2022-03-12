<?php 
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public DateTime $created_at;

    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\Positive(array(
            'message' => 'ID should be > 0'
        )));
        $metadata->addPropertyConstraint('email', new Assert\Email(array(
            'message' => 'The email {{ value }} is invalid.'
        )));
        $metadata->addPropertyConstraint('name', new Assert\Length(array(
            'min'        => 3,
            'minMessage' => 'Name length should be > 3',
        )));
        $metadata->addPropertyConstraint('password', new Assert\Length(array(
            'min'        => 6,
            'minMessage' => 'Password length should be > 6',
        )));
    }

    public function getCreatedAtString(): string
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
