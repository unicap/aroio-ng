################################################################################
#
# perl-tie-cache-lru
#
################################################################################

PERL_TIE_CACHE_LRU_VERSION = 20150301
PERL_TIE_CACHE_LRU_SOURCE = Tie-Cache-LRU-$(PERL_TIE_CACHE_LRU_VERSION).tar.gz
PERL_TIE_CACHE_LRU_SITE = $(BR2_CPAN_MIRROR)/authors/id/M/MS/MSCHWERN
PERL_TIE_CACHE_LRU_DEPENDENCIES = perl-carp-assert perl-class-data-inheritable perl-class-virtual perl-enum
PERL_TIE_CACHE_LRU_LICENSE = Artistic or GPL-1.0+
PERL_TIE_CACHE_LRU_LICENSE_FILES = README

$(eval $(perl-package))
