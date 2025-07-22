<?php

namespace App\Connector;

use App\Queues\KafkaQueue;
use Illuminate\Database\Connectors\ConnectorInterface;

class KafkaConnector implements ConnectorInterface
{
    public function connect(array $config)
    {
        $producerConf = new \RdKafka\Conf();
        $producerConf->set('bootstrap.servers', $config['bootstrap_servers']);
        $producerConf->set('security.protocol', $config['security_protocol']);
        $producerConf->set('sasl.mechanism', $config['sasl_mechanism']);
        $producerConf->set('sasl.username', $config['sasl_username']);
        $producerConf->set('sasl.password', $config['sasl_password']);

        $producer = new \RdKafka\Producer($producerConf);

        $consumerConf = new \RdKafka\Conf();
        $consumerConf->set('bootstrap.servers', $config['bootstrap_servers']);
        $consumerConf->set('security.protocol', $config['security_protocol']);
        $consumerConf->set('sasl.mechanism', $config['sasl_mechanism']);
        $consumerConf->set('sasl.username', $config['sasl_username']);
        $consumerConf->set('sasl.password', $config['sasl_password']);
        $consumerConf->set('group.id', $config['group_id']);
        $consumerConf->set('auto.offset.reset', 'earliest');

        $consumer = new \RdKafka\KafkaConsumer($consumerConf);

        return new KafkaQueue($producer, $consumer);
    }
}