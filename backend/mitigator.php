<?php
// Html mitigation
function html_mitigation($data)
{
    $data = str_replace(' ', ' ', $data); // Replace non-breaking space with space
//    $data = preg_replace("\n", '/\R{2,}/', $data); // Replace multiple new lines with single new line
    $data = str_replace('\n', '<br>', $data); // Replace new line with html break
    $data = trim($data); // Remove whitespace from both sides
    $data = stripslashes($data); // Remove backslashes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities
    $data = nl2br($data); // Replace new lines with <br>
    return $data;
}