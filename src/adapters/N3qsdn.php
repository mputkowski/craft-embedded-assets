<?php

namespace spicyweb\embeddedassets\adapters;

use Embed\Adapters\Webpage;
use Embed\Http\Response;

class N3qsdn extends Webpage
{
    /**
     * {@inheritdoc}
     */
    public static function check(Response $response)
    {
        return $response->isValid() && $response->getUrl()->match([
            '*playout.3qsdn.com/embed/*',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        $this->width = null;
        $this->height = null;

        $playerId = 'player-' . rand(10000, 99999);
        $dataId = $this->getResponse()->getUrl()->getDirectoryPosition(1);

        return '
            <div id="' . $playerId . '"></div>
            <script type="text/javascript">
                var js3qVideoPlayer = new js3q({
                    dataid: "' . $dataId . '",
                    container: "' . $playerId . '",
                    autoplay: true
                });
            </script>';
    }
}