################################################################################
#
# perl-mock-config
#
################################################################################

PERL_MOCK_CONFIG_VERSION = 0.03
PERL_MOCK_CONFIG_SOURCE = Mock-Config-$(PERL_MOCK_CONFIG_VERSION).tar.gz
PERL_MOCK_CONFIG_SITE = $(BR2_CPAN_MIRROR)/authors/id/R/RU/RURBAN
PERL_MOCK_CONFIG_LICENSE = Artistic-2.0
PERL_MOCK_CONFIG_LICENSE_FILES = README

$(eval $(host-perl-package))
