<?php
require_once 'User.php';

class Comment
{
    public User $user;
    public string $text;

    public function __construct(User $user, string $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getCommentHTML(): string
    {
        return "
            Registered: {$this->user->getCreatedAtString()}
            <br>
            {$this->text}
        ";
    }
} 