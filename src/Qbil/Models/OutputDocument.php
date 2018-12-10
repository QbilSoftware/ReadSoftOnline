<?php
/**
 * Created by PhpStorm.
 * User: Faizan Akram <hello@faizanakram.me>
 * Date: 10/12/18
 * Time: 2:02 PM.
 */

namespace Qbil\ReadSoftOnline\Models;

class OutputDocument
{
    public function __construct(array $document)
    {
        $this->DocumentUri = $document['DocumentUri'];
        $this->BatchId = $document['BatchId'];
        $this->BuyerId = $document['BuyerId'];
        $this->ImageUri = $document['ImageUri'];
        $this->ImagePageCount = $document['ImagePageCount'];
        $this->BatchPosition = $document['BatchPosition'];
        $this->DocumentId = $document['DocumentId'];
        $this->OutputOperation = $document['OutputOperation'];
        $this->BatchExternalId = $document['BatchExternalId'];
        $this->CompletionTime = $document['CompletionTime'];
        $this->Metadata = $document['Metadata'];
    }

    private $DocumentUri;
    private $BatchId;
    private $BuyerId;
    private $ImageUri;
    private $ImagePageCount;
    private $BatchPosition;
    private $DocumentId;
    private $OutputOperation;
    private $BatchExternalId;
    private $CompletionTime;
    private $Metadata;

    /**
     * @return mixed
     */
    public function getDocumentUri()
    {
        return $this->DocumentUri;
    }

    /**
     * @return mixed
     */
    public function getBatchId()
    {
        return $this->BatchId;
    }

    /**
     * @return mixed
     */
    public function getBuyerId()
    {
        return $this->BuyerId;
    }

    /**
     * @return mixed
     */
    public function getImageUri()
    {
        return $this->ImageUri;
    }

    /**
     * @return mixed
     */
    public function getImagePageCount()
    {
        return $this->ImagePageCount;
    }

    /**
     * @return mixed
     */
    public function getBatchPosition()
    {
        return $this->BatchPosition;
    }

    /**
     * @return mixed
     */
    public function getDocumentId()
    {
        return $this->DocumentId;
    }

    /**
     * @return mixed
     */
    public function getOutputOperation()
    {
        return $this->OutputOperation;
    }

    /**
     * @return mixed
     */
    public function getBatchExternalId()
    {
        return $this->BatchExternalId;
    }

    /**
     * @return mixed
     */
    public function getCompletionTime()
    {
        return $this->CompletionTime;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->Metadata;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->CustomerId;
    }

    /**
     * @return mixed
     */
    public function getSmallThumbnailUri()
    {
        return $this->SmallThumbnailUri;
    }

    private $CustomerId;
    private $SmallThumbnailUri;
}
