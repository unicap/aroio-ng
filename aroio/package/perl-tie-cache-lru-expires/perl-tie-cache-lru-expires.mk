################################################################################
#
# perl-tie-cache-lru-expires
#
################################################################################

PERL_TIE_CACHE_LRU_EXPIRES_VERSION = 0.55
PERL_TIE_CACHE_LRU_EXPIRES_SOURCE = Tie-Cache-LRU-Expires-$(PERL_TIE_CACHE_LRU_EXPIRES_VERSION).tar.gz
PERL_TIE_CACHE_LRU_EXPIRES_SITE = $(BR2_CPAN_MIRROR)/authors/id/O/OE/OESTERHOL
PERL_TIE_CACHE_LRU_EXPIRES_DEPENDENCIES = perl-tie-cache-lru
PERL_TIE_CACHE_LRU_EXPIRES_LICENSE_FILES = LICENSE

$(eval $(perl-package))
