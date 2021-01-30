<?php
// crud: create, read,  update,  delete,
// ***************************************//

//1 create review  
function createReview($clientId, $invId, $reviewText) {
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (clientId, invId, reviewText)
    VALUES (:clientId, :invId, :reviewText)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}


//2 read an individual review Id
function getReviewById($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews r JOIN clients c ON r.clientId = c.clientId JOIN inventory i ON r.invId = i.invId WHERE r.reviewId = :reviewId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}
//3 read all the reviews by a client Id
function getReviewsByClient($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews r JOIN clients c ON r.clientId = c.clientId JOIN inventory i ON r.invId = i.invId WHERE c.clientId = :clientId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}
//4 read all the reviews for a vehicle by vehicle Id
function getReviewsByVehicle($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM reviews r JOIN clients c ON r.clientId = c.clientId JOIN inventory i ON r.invId = i.invId WHERE i.invId = :invId ORDER BY reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}
//5 update a review 
function updateReview($reviewId, $reviewText) {
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

//6 delete a review 
function deleteReview($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;

}

?>