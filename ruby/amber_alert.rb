require 'nokogiri'
require 'net/http'
require 'cgi'
require 'json'

module AmberAlert

  extend self

  # Get all amber alerts for a given state
  # @param [String] state_abbreviation State, ie: NJ, NY
  def most_recent_by_state(state_abbreviation)
    rss_url = "http://www.missingkids.com/missingkids/servlet/XmlServlet?act=rss&LanguageCountry=en_US&orgPrefix=NCMC&state=#{state_abbreviation}"
    rss = Net::HTTP.get(URI.parse(rss_url))
    doc = Nokogiri::XML.parse(rss)

    url = doc.css('channel item link').first
    case_number = CGI.parse(URI.parse(url).query)['caseNum'][0]

    detail_url = "http://www.missingkids.com/missingkids/servlet/JSONDataServlet?action=childDetail&orgPrefix=NCMC&caseNum=#{case_number}&seqNum=1&caseLang=en_US&searchLang=en_US&LanguageId=en_US"
    details_raw = Net::HTTP.get(URI.parse(detail_url))
    details = JSON.parse(details_raw)
    details['photo'] = "http://www.missingkids.com/photographs/NCMC#{case_number}c1.jpg";
    details
  end

end

puts AmberAlert.most_recent_by_state('NJ').inspect
