################################################################################
#
# perl-network-ipv4addr
#
################################################################################

PERL_NETWORK_IPV4ADDR_VERSION = 0.05
PERL_NETWORK_IPV4ADDR_SOURCE = Network-IPv4Addr-$(PERL_NETWORK_IPV4ADDR_VERSION).tar.gz
PERL_NETWORK_IPV4ADDR_SITE = $(BR2_CPAN_MIRROR)/authors/id/F/FR/FRAJULAC
PERL_NETWORK_IPV4ADDR_LICENSE_FILES = README

$(eval $(perl-package))
