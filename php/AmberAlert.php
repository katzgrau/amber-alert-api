<?php

class AmberAlert {

    /**
     * Get all Amber Alerts for a given state
     * @param $state_abbrev NJ, NY, etc
     * @param bool $today_only True to get today's Amber Alerts, false to get all available
     */
    public static function getMostRecentAlertByState($state_abbrev) {
        /* Get the public RSS URL by state abbreviation */
        $rss_url = "http://www.missingkids.com/missingkids/servlet/XmlServlet?act=rss&LanguageCountry=en_US&orgPrefix=NCMC&state=$state_abbrev";

        /* Parse the RSS and sniff out the case number for the
           most recent abductee */
        $rss = file_get_contents($rss_url);
        $xml = new SimpleXmlElement($rss);

        $url_components = parse_url($xml->channel->item->link);
        parse_str($url_components['query'], $args);

        /* Pull the full details for the abductee for NCMC's "API", if you can call it that */
        $detail_url = "http://www.missingkids.com/missingkids/servlet/JSONDataServlet?action=childDetail&orgPrefix=NCMC&caseNum={$args['caseNum']}&seqNum=1&caseLang=en_US&searchLang=en_US&LanguageId=en_US";
        $details = json_decode(file_get_contents($detail_url))->childBean;

        /* Add a photo - why this isn't already in the JSON, who knows */
        $details->photo = "http://www.missingkids.com/photographs/NCMC{$args['caseNum']}c1.jpg";

        return $details;
    }
}