<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MeiliSearch\Client;

class MeilisearchSetting extends Command
{
    protected $signature = 'scout:setting {--d|delete : Reset to default values}';

    protected $description = 'Update Meilisearch settings.';

    private $client;

    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client->index('threads');
    }

    public function handle()
    {
        $this->option('delete') ? $this->delete() : $this->update();
    }

    public function update()
    {
        $this->client->updateRankingRules([
            'typo',
            'words',
            'proximity',
            'attribute',
            'wordsPosition',
            'exactness',
            'desc(replies_count)'
        ]);

        $this->client->updateSearchableAttributes(['title', 'body']);

        $this->info('Settings has been updated successfully');
    }

    public function delete()
    {
        $this->client->resetRankingRules();

        $this->client->resetSearchableAttributes();

        $this->info('Settings has been reset');
    }
}
