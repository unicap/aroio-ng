################################################################################
#
# perl-hash-merge
#
################################################################################

PERL_HASH_MERGE_VERSION = 0.299
PERL_HASH_MERGE_SOURCE = Hash-Merge-$(PERL_HASH_MERGE_VERSION).tar.gz
PERL_HASH_MERGE_SITE = $(BR2_CPAN_MIRROR)/authors/id/H/HE/HERMES
PERL_HASH_MERGE_DEPENDENCIES = perl-clone-choose
PERL_HASH_MERGE_LICENSE = Artistic or GPL-1.0+

$(eval $(perl-package))
