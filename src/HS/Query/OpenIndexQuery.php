<?php

namespace HS\Query;

use HS\Validator;

/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */
class OpenIndexQuery extends QueryAbstract
{

    public function __construct(array $parameterList)
    {
        parent::__construct($parameterList);

        if ($this->getParameterBag()->isExists('columnList')) {
            Validator::validateColumnList($this->getParameter('columnList'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryString()
    {
        return sprintf("P\t%d\t%s\t%s\t%s\t%s\t%s",
            $this->getParameter('indexId'),
            $this->getParameter('dbName'),
            $this->getParameter('tableName'),
            $this->getParameter('indexName'),
            implode(',', $this->getParameter('columnList')),
            implode(',', $this->getParameter('filterColumnList'))
        );
    }
}