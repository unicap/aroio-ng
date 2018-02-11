################################################################################
#
# perl-xml-simple
#
################################################################################

PERL_XML_SIMPLE_VERSION = 2.24
PERL_XML_SIMPLE_SOURCE = XML-Simple-$(PERL_XML_SIMPLE_VERSION).tar.gz
PERL_XML_SIMPLE_SITE = $(BR2_CPAN_MIRROR)/authors/id/G/GR/GRANTM
PERL_XML_SIMPLE_DEPENDENCIES = perl-xml-namespacesupport perl-xml-sax perl-xml-sax-expat
PERL_XML_SIMPLE_LICENSE = Artistic or GPL-1.0+
PERL_XML_SIMPLE_LICENSE_FILES = LICENSE

$(eval $(perl-package))
